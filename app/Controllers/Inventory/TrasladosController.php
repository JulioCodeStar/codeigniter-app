<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\ExitsDetailsModel;
use App\Models\Inventory\ExitsModel;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductsModel;
use App\Models\Inventory\ProductsSerialsModel;
use App\Models\Inventory\RequirementsModel;
use App\Models\Inventory\TrasladosDetailsModel;
use App\Models\Inventory\TrasladosModel;
use App\Models\SedeModel;
use CodeIgniter\HTTP\ResponseInterface;

class TrasladosController extends BaseController
{
    protected $sedeModel, $requirementModel, $productModel, $inventoryModel, $productsSerialsModel, $db, $trasladoModel, $trasladoDetailsModel, $exitModel, $exitsDetailsModel;

    public function __construct()
    {
        $this->sedeModel            = new SedeModel();
        $this->requirementModel     = new RequirementsModel();
        $this->productModel         = new ProductsModel();
        $this->inventoryModel       = new InventoryModel();
        $this->productsSerialsModel = new ProductsSerialsModel();
        $this->trasladoModel        = new TrasladosModel();
        $this->trasladoDetailsModel = new TrasladosDetailsModel();
        $this->exitModel            = new ExitsModel();
        $this->exitsDetailsModel    = new ExitsDetailsModel();

        $this->db                   = \Config\Database::connect();
    }

    public function index()
    {

        $traslados = $this->trasladoModel
            ->select('inventory_traslados.*, sedes.sucursal as sede_origen, sedes2.sucursal as sede_destino, inventory_requirements.codigo as codigo_requerimiento, inventory_exits.codigo as codigo_salida')
            ->join('sedes', 'sedes.id = inventory_traslados.sede_origen', 'left')
            ->join('sedes as sedes2', 'sedes2.id = inventory_traslados.sede_destino', 'left')
            ->join('inventory_requirements', 'inventory_requirements.id = inventory_traslados.requirement_id', 'left')
            ->join('inventory_exits', 'inventory_exits.traslado_id = inventory_traslados.id', 'left')
            ->findAll();

        $statusClass = [
            'pendiente'    => 'secondary',
            'aprobado'     => 'primary',
            'empaquetando' => 'info',
            'en tránsito'  => 'warning',
            'recibido'     => 'success',
            'cancelado'    => 'danger',
        ];
        // Define transiciones para cada estado
        $allowedTransitions = [
            'pendiente'    => ['aprobado', 'cancelado'],
            'aprobado'     => ['empaquetando', 'cancelado'],
            'empaquetando' => ['en transito', 'cancelado'],
            'en transito'  => ['recibido', 'cancelado'],
            'recibido'     => [],
            'cancelado'    => [],
        ];

        if (session('inventory_user')['sede_id'] == 1) {
            return view('inventory/traslados/index', compact('traslados', 'statusClass', 'allowedTransitions'));
        } else {
            return redirect()->to(base_url('inventory'));
        }
    }

    public function new()
    {
        $requirements = $this->requirementModel
            ->select('inventory_requirements.codigo, inventory_requirements.id, inventory_requirements.nombre_solicitante, sedes.sucursal as sede_origen, sedes2.sucursal as sede_destino, areas.nombres as area_solicitante')
            ->join('sedes', 'sedes.id = inventory_requirements.sede_origen', 'left')
            ->join('sedes as sedes2', 'sedes2.id = inventory_requirements.sede_destino', 'left')
            ->join('areas', 'areas.id = inventory_requirements.area_solicitante', 'left')
            ->where('inventory_requirements.estado', 'pendiente')
            ->findAll();

        $sedes = $this->sedeModel->findAll();

        if (session('inventory_user')['sede_id'] == 1) {
            return view('inventory/traslados/new', compact('requirements', 'sedes'));
        } else {
            return redirect()->to(base_url('inventory'));
        }
    }

    public function showListTable(int $id)
    {
        try {
            $req = $this->requirementModel->find($id);
            if (! $req) {
                return $this->response->setStatusCode(404)
                    ->setJSON(['status' => 404, 'message' => 'Requerimiento no encontrado']);
            }

            $items = json_decode($req['items'], true) ?: [];
            $details = [];

            foreach ($items as $i => $it) {
                // 1) Producto y flag de serie
                $prodRow = $this->productModel->find($it['product_id']);
                $requires = (bool) ($prodRow['requiere_serie'] ?? false);

                // 2) Stock en sede_origen
                $stockRow = $this->inventoryModel
                    ->where('product_id', $it['product_id'])
                    ->where('sede_id', $req['sede_destino'])
                    ->first();
                $stock = $stockRow['stock'] ?? 0;

                // 3) Series disponibles SI require
                $available = [];
                if ($requires) {
                    $serials = $this->productsSerialsModel
                        ->select('serial')
                        ->where('inventory_product_id', $it['product_id'])
                        ->where('sede_id', $req['sede_destino'])
                        ->where('estado', 'disponible')
                        ->findAll();
                    $available = array_column($serials, 'serial');
                }

                $details[] = [
                    'product_id'      => $it['product_id'],
                    'codigo'           => $prodRow['codigo']    ?? '',
                    'nombre'           => $prodRow['nombre']    ?? '',
                    'cantidad'         => (int)$it['cantidad'],
                    'stock_disponible' => (int)$stock,
                    'requires_serie'   => $requires,
                    'series'           => $available,
                ];
            }

            return $this->response->setJSON([
                'status'        => 200,
                'requerimiento' => [
                    'id'             => $req['id'],
                    'codigo'         => $req['codigo'],
                    'sede_origen'    => $req['sede_destino'],
                    'sede_destino'   => $req['sede_origen'],
                ],
                'details'       => $details,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error show(): ' . $e->getMessage());
            return $this->response->setStatusCode(500)
                ->setJSON(['status' => 500, 'message' => 'Error al obtener el requerimiento']);
        }
    }

    public function create()
    {
        try {
            $post = $this->request->getPost();
            $this->db->transStart();

            // 1) Decodificar items de traslado (array de { product_id, cantidad, serials })
            $items = json_decode($post['items_traslate'] ?? '[]', true);
            if (! is_array($items) || empty($items)) {
                throw new \RuntimeException('No hay productos para trasladar.');
            }

            // 2) Crear registro de traslado
            $trasladoData = [
                'requirement_id' => $post['requerimiento_id'],
                'sede_origen'    => session('inventory_user')['sede_id'],
                'sede_destino'   => $post['sede_destino'],
                'detalles'       => $post['detalles'] ?? null,
                'estado'         => 'aprobado',
            ];
            $trasladoId = $this->trasladoModel->insert($trasladoData, true);
            if (! $trasladoId) {
                log_message('error', 'TrasladosModel errors: ' . print_r($this->trasladoModel->errors(), true));
                log_message('error', 'DB error: ' . json_encode($this->db->error()));
                throw new \RuntimeException('No se pudo crear el traslado.');
            }

            // 3) Marcar el requerimiento como aprobado
            $this->requirementModel->update($post['requerimiento_id'], ['estado' => 'aprobado']);

            // 4) Crear salida asociada
            $sedeDestino = $this->sedeModel->find($post['sede_destino']);
            $reqDetails  = $this->requirementModel->find($post['requerimiento_id']);
            $exitData = [
                'tipo'                => 'Traslado',
                'nombre_externo'      => 'Traslado a ' . ($sedeDestino['sucursal'] ?? ''),
                'area_solicitante'    => $reqDetails['area_solicitante'],
                'nombre_solicitante'  => $reqDetails['nombre_solicitante'],
                'responsable_almacen' => 'Sistema',
                'fecha_salida'        => date('Y-m-d'),
                'sede_id'             => session('inventory_user')['sede_id'],
                'traslado_id'         => $trasladoId,
                'estado'              => 'aprobado',
            ];
            $exitId = $this->exitModel->insert($exitData, true);
            if (! $exitId) {
                log_message('error', 'ExitsModel errors: ' . print_r($this->exitModel->errors(), true));
                log_message('error', 'DB error: ' . json_encode($this->db->error()));
                throw new \RuntimeException('No se pudo crear la salida.');
            }

            // 5) Insertar detalles de salida y de traslado, y actualizar series
            foreach ($items as $detail) {
                // 5.1) Salida detalle
                $exitDetailData = [
                    'inventory_exit_id'    => $exitId,
                    'inventory_product_id' => $detail['product_id'],
                    'cantidad'             => $detail['cantidad'],
                ];
                $exitDetailId = $this->exitsDetailsModel->insert($exitDetailData, true);
                if (! $exitDetailId) {
                    throw new \RuntimeException("No se pudo guardar detalle de salida para producto {$detail['product_id']}.");
                }

                // 5.2) Traslado detalle
                $trasladoDetailData = [
                    'traslado_id'                   => $trasladoId,
                    'producto_id'                   => $detail['product_id'],
                    'cantidad'                      => $detail['cantidad'],
                    'inventory_exits_details_id'    => $exitDetailId,
                ];
                $trasladoDetailId = $this->trasladoDetailsModel->insert($trasladoDetailData, true);
                if (! $trasladoDetailId) {
                    throw new \RuntimeException("No se pudo guardar detalle de traslado para producto {$detail['product_id']}.");
                }

                // 5.3) Actualizar estados de series si existen
                if (! empty($detail['serials']) && is_array($detail['serials'])) {
                    foreach ($detail['serials'] as $serial) {
                        $this->productsSerialsModel
                            ->where('inventory_product_id', $detail['product_id'])
                            ->where('sede_id',             session('inventory_user')['sede_id'],)
                            ->where('serial',              $serial)
                            ->where('estado',              'Disponible')
                            ->set([
                                'estado'                     => 'En Transito',
                                'inventory_exits_details_id' => $exitDetailId,
                            ])
                            ->update();
                    }
                }

                // 5.4) Actualizar stock en sede_origen
                $this->inventoryModel
                    ->where('sede_id', session('inventory_user')['sede_id'])
                    ->where('product_id', $detail['product_id'])
                    ->set('stock', 'stock - ' . (float) $detail['cantidad'], false)
                    ->update();
            }

            // 6) Commit / rollback
            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Error en transacción, se hizo rollback.');
            }

            // 7) Respuesta AJAX
            return $this->response->setJSON([
                'status'     => 200,
                'message'    => 'Traslado creado exitosamente',
                'trasladoId' => $trasladoId,
            ]);
        } catch (\Exception $e) {
            if ($this->db->transStatus() !== false) {
                $this->db->transRollback();
            }
            log_message('error', 'Error create(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(\CodeIgniter\HTTP\ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al crear el traslado: ' . $e->getMessage(),
                ]);
        }
    }

    public function show(int $id)
    {
        try {
            $traslado = $this->trasladoModel
                ->select('
                inventory_traslados.*,
                origin.sucursal      AS sede_origen_nombre,
                dest.sucursal        AS sede_destino_nombre,
                areas.nombres          AS area_solicitante_nombre,
                inventory_requirements.nombre_solicitante AS nombre_requerimiento
            ')
                ->join('sedes AS origin', 'origin.id = inventory_traslados.sede_origen')
                ->join('sedes AS dest',   'dest.id   = inventory_traslados.sede_destino')
                ->join('inventory_requirements', 'inventory_requirements.id = inventory_traslados.requirement_id')
                ->join('areas', 'areas.id = inventory_requirements.area_solicitante')
                ->find($id);

            if (! $traslado) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 404, 'message' => 'Traslado no encontrado']);
            }

            // 2) Recupera el código de la salida asociada
            $exit = $this->exitModel
                ->where('traslado_id', $id)
                ->first();

            // 3) Detalles del traslado + info de producto
            $details = $this->trasladoDetailsModel
                ->select('
                    inventory_traslados_details.id,
                    inventory_traslados_details.producto_id,
                    inventory_traslados_details.cantidad,
                    inventory_traslados_details.inventory_exits_details_id,
                    inventory_products.codigo,
                    inventory_products.nombre
                ')
                ->join('inventory_products', 'inventory_products.id = inventory_traslados_details.producto_id')
                ->where('inventory_traslados_details.traslado_id', $id)
                ->findAll();

            // 4) Anexa los seriales a cada detalle
            foreach ($details as &$det) {
                $serials = $this->productsSerialsModel
                    ->where('inventory_exits_details_id',    $det['inventory_exits_details_id'])
                    ->where('inventory_product_id',          $det['producto_id'])
                    ->findAll();
                $det['serials'] = array_column($serials, 'serial');
            }

            // 5) Devuelve JSON
            return $this->response->setJSON([
                'status'   => 200,
                'traslado' => $traslado,
                'codigo'   => $exit['codigo'] ?? null,
                'details'  => $details,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error show(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al obtener el traslado: ' . $e->getMessage(),
                ]);
        }
    }

    public function updateStatus(int $id)
    {
        helper('filesystem');
        try {
            if (! $this->request->isAJAX()) {
                throw new \RuntimeException('Solicitud inválida');
            }
            $input     = $this->request->getJSON(true);       // obtiene el body JSON como array
            $newStatus = $input['status']   ?? null;
            $allowed = [
                'pendiente'    => ['aprobado', 'cancelado'],
                'aprobado'     => ['empaquetando', 'cancelado'],
                'empaquetando' => ['en transito', 'cancelado'],
                'en transito'  => ['recibido', 'cancelado'],
                'recibido'     => [],   // fin
                'cancelado'    => [],   // fin
            ];

            $traslado = $this->trasladoModel->find($id);
            if (! $traslado) {
                return $this->response->setStatusCode(404)
                    ->setJSON(['status' => 404, 'message' => 'Traslado no encontrado']);
            }

            $current = $traslado['estado'];
            if (! in_array($newStatus, $allowed[$current] ?? [])) {
                return $this->response->setStatusCode(400)
                    ->setJSON(['status' => 400, 'message' => "No se puede pasar de {$current} a {$newStatus}"]);
            }

            $this->trasladoModel->update($id, ['estado' => $newStatus]);
            return $this->response->setJSON([
                'status'  => 200,
                'message' => "Estado actualizado a “{$newStatus}”",
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error updateStatus(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(500)
                ->setJSON(['status' => 500, 'message' => 'Error interno al cambiar estado']);
        }
    }
}
