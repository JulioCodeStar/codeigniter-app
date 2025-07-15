<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\AreaModel;
use App\Models\Inventory\AreaModel as InventoryAreaModel;
use App\Models\Inventory\ExitsDetailsModel;
use App\Models\Inventory\ExitsModel;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductsModel;
use App\Models\Inventory\ProductsSerialsModel;
use App\Models\PatientModel;
use App\Models\SedeModel;
use CodeIgniter\HTTP\ResponseInterface;

class ExitController extends BaseController
{
    protected $sedeModel, $areaModel, $pacienteModel, $productModel, $exitsModel, $exitsDetailsModel, $productsSerialsModel, $inventoryModel, $db, $hoy;

    public function __construct()
    {
        $this->sedeModel            = new SedeModel();
        $this->areaModel            = new InventoryAreaModel();
        $this->pacienteModel        = new PatientModel();
        $this->productModel         = new ProductsModel();
        $this->exitsModel           = new ExitsModel();
        $this->exitsDetailsModel    = new ExitsDetailsModel();
        $this->productsSerialsModel = new ProductsSerialsModel();
        $this->inventoryModel       = new InventoryModel();

        $this->hoy                  = date('Y-m-d');
        $this->db                   = \Config\Database::connect();
    }

    public function index()
    {
        $sedes = $this->sedeModel->find(session('inventory_user')['sede_id']);
        $exits = $this->exitsModel
            ->select('inventory_exits.*, areas.nombres AS area')
            ->join('areas', 'areas.id = inventory_exits.area_solicitante', 'left')
            ->where('inventory_exits.sede_id', session('inventory_user')['sede_id'])
            ->findAll();
        $totalExits = $this->exitsModel
            ->where('DATE(inventory_exits.created_at) =', $this->hoy)
            ->where('inventory_exits.sede_id', session('inventory_user')['sede_id'])
            ->countAllResults();
        $exitsThisWeek = $this->getExitsByWeek();
        return view('inventory/salidas/index', compact('sedes', 'exits', 'totalExits', 'exitsThisWeek'));
    }

    public function getExitsByWeek()
    {
        // Get the start and end of the current week
        $now = new \DateTime('now', new \DateTimeZone('America/Bogota'));
        $startOfWeek = clone $now;
        $startOfWeek->modify('monday this week')->setTime(0, 0, 0);
        $endOfWeek = clone $now;
        $endOfWeek->modify('sunday this week')->setTime(23, 59, 59);

        // Get entries from this week
        $thisWeekEntries = $this->exitsModel
            ->where('sede_id', session('inventory_user')['sede_id'])
            ->where("DATE(fecha_salida) >=", $startOfWeek->format('Y-m-d'))
            ->where("DATE(fecha_salida) <=", $endOfWeek->format('Y-m-d'))
            ->findAll();

        // Get entries from previous weeks
        $previousWeeks = [];
        for ($i = 1; $i <= 4; $i++) {
            $start = clone $startOfWeek;
            $end = clone $endOfWeek;
            $start->modify("-{$i} weeks");
            $end->modify("-{$i} weeks");

            $entries = $this->exitsModel
                ->where("DATE(fecha_salida) >=", $start->format('Y-m-d'))
                ->where("DATE(fecha_salida) <=", $end->format('Y-m-d'))
                ->where('sede_id', session('inventory_user')['sede_id'])
                ->findAll();

            $previousWeeks[] = [
                'week' => "Semana " . ($i + 1),
                'exits' => $entries,
                'start_date' => $start->format('Y-m-d'),
                'end_date' => $end->format('Y-m-d')
            ];
        }

        return [
            'this_week' => [
                'exits' => $thisWeekEntries,
                'start_date' => $startOfWeek->format('Y-m-d'),
                'end_date' => $endOfWeek->format('Y-m-d')
            ],
            'previous_weeks' => array_reverse($previousWeeks)
        ];
    }

    public function new()
    {
        $sedes = $this->sedeModel->find(session('inventory_user')['sede_id']);
        $areas = $this->areaModel->findAll();
        $pacientes = $this->pacienteModel->findAll();

        $products_stock = $this->productModel
            ->select('inventory_products.*, inventory.stock')
            ->join('inventory', 'inventory.product_id = inventory_products.id', 'left')
            ->join('sedes', 'sedes.id = inventory.sede_id', 'left')
            ->where('inventory.sede_id', session('inventory_user')['sede_id'])
            ->findAll();


        return view('inventory/salidas/new', compact('sedes', 'areas', 'pacientes', 'products_stock'));
    }

    public function availableSeries()
    {
        $product_id = $this->request->getGet('product_id');
        $sede_id = $this->request->getGet('sede_id');
        $q = $this->request->getGet('q');

        $series = $this->productModel
            ->select('inventory_products.*, inventory_products_serials.serial')
            ->join('inventory_products_serials', 'inventory_products_serials.inventory_product_id = inventory_products.id', 'left')
            ->join('sedes', 'sedes.id = inventory_products_serials.sede_id', 'left')
            ->where('inventory_products_serials.sede_id', session('inventory_user')['sede_id'])
            ->where('inventory_products.id', $product_id)
            ->where('inventory_products_serials.estado', 'Disponible')
            ->orderBy('inventory_products_serials.serial', 'ASC')
            ->findAll();

        return json_encode($series);
    }

    public function create()
    {
        try {
            $post = $this->request->getPost();
            $sede = session('inventory_user')['sede_id'];

            $this->db->transStart();

            $data_exits = [
                'tipo'                      => $post['tipo'],
                'id_paciente'               => $post['nombre_paciente'] ?? null,
                'nombre_externo'            => $post['nombre_proyecto'] ?? null,
                'area_solicitante'          => $post['area_solicitante'],
                'nombre_solicitante'        => $post['solicitante'],
                'responsable_almacen'       => $post['responsable_almacen'],
                'fecha_salida'              => $post['fecha_salida'],
                'notas'                     => $post['observacion'] ?? null,
                'sede_id'                   => $sede,
            ];

            $exitId = $this->exitsModel->insert($data_exits, true);
            if (! $exitId) {
                log_message('error', 'ExitsModel errors: ' . print_r($this->exitsModel->errors(), true));
                log_message('error', 'DB error: ' . json_encode($this->db->error()));
                throw new \RuntimeException('No se pudo crear la salida.');
            }

            // 2) Procesa cada producto: detalle, stock y seriales
            $productIds = $post['producto_id'] ?? [];
            $quantities = $post['cantidad']   ?? [];
            $allSerials = $post['serials']    ?? [];

            foreach ($productIds as $i => $pid) {
                $qty = (int) ($quantities[$i] ?? 0);
                if ($qty < 1) {
                    throw new \RuntimeException("Cantidad inválida para producto {$pid}.");
                }

                // 2.1) Inserta detalle
                $detailData = [
                    'inventory_exit_id'    => $exitId,
                    'inventory_product_id' => $pid,
                    'cantidad'             => $qty,
                ];
                $detailId = $this->exitsDetailsModel->insert($detailData, true);
                if (! $detailId) {
                    log_message('error', 'ExitsDetailsModel errors: ' . print_r($this->exitsDetailsModel->errors(), true));
                    log_message('error', 'DB error: ' . json_encode($this->db->error()));
                    throw new \RuntimeException("No se pudo guardar detalle para producto {$pid}.");
                }

                // 2.2) Descuenta stock
                $stockRow = $this->inventoryModel
                    ->where('product_id', $pid)
                    ->where('sede_id',    $sede)
                    ->first();
                if ($stockRow) {
                    $newStock = max(0, $stockRow['stock'] - $qty);
                    $builder = $this->db->table($this->inventoryModel->table);
                    $builder->set('stock', $newStock)
                        ->where('product_id', $pid)
                        ->where('sede_id',    $sede)
                        ->update();
                }

                // 2.3) Marca seriales como 'Utilizado'
                $serialsForThis = $allSerials[$i] ?? [];
                foreach ($serialsForThis as $ser) {
                    $this->productsSerialsModel
                        ->where('inventory_product_id', $pid)
                        ->where('serial',               $ser)
                        ->where('sede_id',              $sede)
                        ->set([
                            'estado'                     => 'Utilizado',
                            'inventory_exits_details_id' => $detailId,
                        ])
                        ->update();
                }
            }

            // 3) Commit de la transacción
            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Error en transacción, se hizo rollback.');
            }

            // 4) Respuesta
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 200,
                    'message' => 'Salida creada correctamente',
                    'exitId'  => $exitId,
                ]);
            }

            return redirect()
                ->to(base_url('inventory/exits'))
                ->with('success', 'Salida creada correctamente');
        } catch (\Exception $e) {
            // Rollback manual por si acaso
            if ($this->db->transStatus() !== false) {
                $this->db->transRollback();
            }
            log_message('error', 'Error create(): ' . $e->getMessage());
            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear la salida: ' . $e->getMessage(),
                    ]);
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            // 1) Obtener la salida
            $exit = $this->exitsModel->find($id);
            if (! $exit) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON([
                        'status'  => 404,
                        'message' => 'Salida no encontrada'
                    ]);
            }

            // 2) Obtener detalles con código y nombre de producto
            $details = $this->exitsDetailsModel
                ->select('inventory_exits_details.id,
                      inventory_exits_details.inventory_exit_id,
                      inventory_exits_details.inventory_product_id AS product_id,
                      inventory_exits_details.cantidad,
                      inventory_products.codigo,
                      inventory_products.nombre')
                ->join('inventory_products', 'inventory_products.id = inventory_exits_details.inventory_product_id')
                ->where('inventory_exit_id', $id)
                ->findAll();

            // 3) Anexar seriales a cada detalle
            foreach ($details as &$det) {
                $serials = $this->productsSerialsModel
                    ->select('serial')
                    ->where('inventory_exits_details_id', $det['id'])
                    ->findAll();
                $det['serials'] = array_column($serials, 'serial');
            }

            // 4) Responder JSON con la cabecera y los detalles
            return $this->response->setJSON([
                'status'  => 200,
                'exit'    => $exit,
                'details' => $details,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error showExit(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al obtener la salida: ' . $e->getMessage(),
                ]);
        }
    }

    public function delete($id)
    {
        // Sólo por POST y con un ID válido
        if (! $this->request->is('post') || empty($id)) {
            return redirect()->to('inventory/entries');
        }

        // Inicia transacción
        $this->db->transStart();

        // 1) Recupera todos los detalles de esta entrada
        $details = $this->exitsDetailsModel
            ->where('inventory_exit_id', $id)
            ->findAll();

        // 2) Por cada detalle, descuenta la cantidad del stock y actualiza seriales
        $sedeId = session('inventory_user')['sede_id'];

        // 2.1) Actualizar seriales relacionados
        foreach ($details as $det) {
            $builder_serial = $this->db->table($this->productsSerialsModel->table);
            $builder_serial->where('inventory_exits_details_id', $det['id'])
                ->set([
                    'estado' => 'Disponible',
                    'inventory_exits_details_id' => null
                ])
                ->update();
        }
        foreach ($details as $det) {
            $prodId = $det['inventory_product_id'];
            $qty    = (int) $det['cantidad'];

            // Encuentra el registro de stock
            $stockRow = $this->inventoryModel
                ->where('product_id', $prodId)
                ->where('sede_id',    $sedeId)
                ->first();

            if ($stockRow) {
                // Calcula el nuevo stock (sin caer en negativo)
                $newStock = max(0, $stockRow['stock'] + $qty);

                // Actualiza stock especificando las columnas en builder
                $builder = $this->db->table($this->inventoryModel->table);
                $builder->set('stock', $newStock)
                    ->where('product_id', $prodId)
                    ->where('sede_id',    $sedeId)
                    ->update();

                if ($this->db->error()['code'] !== 0) {
                    log_message('error', 'DB error al actualizar stock: ' . json_encode($this->db->error(), JSON_PRETTY_PRINT));
                    throw new \RuntimeException("No se pudo actualizar stock para producto {$prodId}.");
                }
            }
        }

        // 3) Eliminar detalles de la salida
        $this->exitsDetailsModel->delete($id);

        // 4) Eliminar la salida
        $this->exitsModel->delete($id);

        // 5) Commit / rollback
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            log_message('error', "Error al eliminar salida {$id}");
            return redirect()->back()->with('error', 'No se pudo eliminar la salida.');
        }

        return redirect()
            ->to('inventory/exits')
            ->with('success', 'Salida eliminada y stock ajustado.');
    }
}
