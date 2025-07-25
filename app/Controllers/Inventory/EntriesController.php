<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\EntriesDetailsModel;
use App\Models\Inventory\EntriesModel;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductsModel;
use App\Models\Inventory\ProductsSerialsModel;
use App\Models\SedeModel;
use CodeIgniter\HTTP\ResponseInterface;

class EntriesController extends BaseController
{
    protected $db, $entryModel, $sedeModel, $productModel, $productsSerialsModel, $entriesDetailsModel, $hoy, $inventoryModel;

    public function __construct()
    {
        $this->entryModel           = new EntriesModel();
        $this->sedeModel            = new SedeModel();
        $this->productModel         = new ProductsModel();
        $this->productsSerialsModel = new ProductsSerialsModel();
        $this->entriesDetailsModel  = new EntriesDetailsModel();
        $this->inventoryModel       = new InventoryModel();

        $this->db                   = \Config\Database::connect();
        $this->hoy                  = date('Y-m-d');
    }

    public function index()
    {
        $entries = $this->entryModel->where('sede_id', session('inventory_user')['sede_id'])->findAll();
        $totalEntries = $this->entryModel->where('sede_id', session('inventory_user')['sede_id'])->where('DATE(created_at) >=', $this->hoy)->countAllResults();
        $sedes = $this->sedeModel->find(session('inventory_user')['sede_id']);
        $entriesThisWeek = $this->getEntriesByWeek();
        return view('inventory/entradas/index', [
            'entries' => $entries,
            'sedes' => $sedes,
            'totalEntries' => $totalEntries,
            'entriesThisWeek' => $entriesThisWeek
        ]);
    }

    public function getEntriesByWeek()
    {
        // Get the start and end of the current week
        $now = new \DateTime('now', new \DateTimeZone('America/Bogota'));
        $startOfWeek = clone $now;
        $startOfWeek->modify('monday this week')->setTime(0, 0, 0);
        $endOfWeek = clone $now;
        $endOfWeek->modify('sunday this week')->setTime(23, 59, 59);

        // Get entries from this week
        $thisWeekEntries = $this->entryModel
            ->where('sede_id', session('inventory_user')['sede_id'])
            ->where("DATE(fecha_recepcion) >=", $startOfWeek->format('Y-m-d'))
            ->where("DATE(fecha_recepcion) <=", $endOfWeek->format('Y-m-d'))
            ->findAll();

        // Get entries from previous weeks
        $previousWeeks = [];
        for ($i = 1; $i <= 4; $i++) {
            $start = clone $startOfWeek;
            $end = clone $endOfWeek;
            $start->modify("-{$i} weeks");
            $end->modify("-{$i} weeks");

            $entries = $this->entryModel
                ->where("DATE(fecha_recepcion) >=", $start->format('Y-m-d'))
                ->where("DATE(fecha_recepcion) <=", $end->format('Y-m-d'))
                ->where('sede_id', session('inventory_user')['sede_id'])
                ->findAll();

            $previousWeeks[] = [
                'week' => "Semana " . ($i + 1),
                'entries' => $entries,
                'start_date' => $start->format('Y-m-d'),
                'end_date' => $end->format('Y-m-d')
            ];
        }

        return [
            'this_week' => [
                'entries' => $thisWeekEntries,
                'start_date' => $startOfWeek->format('Y-m-d'),
                'end_date' => $endOfWeek->format('Y-m-d')
            ],
            'previous_weeks' => array_reverse($previousWeeks)
        ];
    }

    public function new()
    {
        $sedes = $this->sedeModel->find(session('inventory_user')['sede_id']);
        $products = $this->productModel->findAll();
        return view('inventory/entradas/new', compact('sedes', 'products'));
    }

    public function getAutoSerials()
    {
        $productId = (int) $this->request->getVar('product_id');
        $quantity  = (int) $this->request->getVar('quantity');

        $seriales     = $this->productsSerialsModel->generateSerials($productId, $quantity);

        return $this->response->setJSON([
            'count'   => count($seriales),
            'serials' => $seriales
        ]);
    }

    public function checkSerial()
    {
        $serial = $this->request->getPost('serial');
        if (!$serial) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['error' => 'Serial no enviado']);
        }

        $exists = (bool) $this->productsSerialsModel
            ->where('serial', $serial)
            ->where('estado', 'Disponible')
            ->countAllResults();

        return $this->response->setJSON(['exists' => $exists]);
    }

    public function checkSerials()
    {
        $input = $this->request->getJSON(true);
        $list  = $input['serials'] ?? [];

        $exis = $this->productsSerialsModel
            ->whereIn('serial', $list)
            ->where('estado', 'Disponible')
            ->findColumn('serial');

        return $this->response->setJSON([
            'exists'    => $exis,
            'nonexists' => array_diff($list, $exis)
        ]);
    }

    public function create()
    {
        try {
            $post = $this->request->getPost();

            // Inicia transacción
            $this->db->transStart();

            // 1) Inserta cabecera (inventory_entries)
            $dataEntry = [
                'tipo'            => $post['tipo'],
                'descripcion'     => $post['descripcion'],
                'fecha_recepcion' => $post['fecha_recepcion'],
                'responsable'     => $post['responsable'],
                'proveedor'       => $post['proveedor'] ?? null,
                'sede_id'         => session('inventory_user')['sede_id'],
                'observacion'     => $post['observacion'] ?? null,
            ];
            $entryId = $this->entryModel->insert($dataEntry, true);
            if (!$entryId) {
                log_message('error', 'EntriesModel errors: ' . print_r($this->entryModel->errors(), true));
                log_message('error', 'DB error: ' . json_encode($this->db->error()));
                throw new \RuntimeException('No se pudo crear la entrada.');
            }

            // 2) Inserta cada detalle + sus seriales
            $productIds = $post['producto_id'];
            $quantities = $post['cantidad'];
            $allSerials = $post['serials'] ?? [];
            $sedeId = session('inventory_user')['sede_id'];

            foreach ($productIds as $i => $productId) {
                $qty = (int) ($quantities[$i] ?? 0);
                if ($qty < 1) {
                    throw new \RuntimeException("Cantidad inválida para producto {$productId}.");
                }

                // 2.1) Detalle
                $detailData = [
                    'inventory_entry_id' => $entryId,
                    'product_id'         => $productId,
                    'cantidad'           => $qty,
                ];
                $detailId = $this->entriesDetailsModel->insert($detailData, true);
                if (!$detailId) {
                    log_message('error', 'EntriesDetailsModel errors: ' . print_r($this->entriesDetailsModel->errors(), true));
                    log_message('error', 'DB error: ' . json_encode($this->db->error()));
                    throw new \RuntimeException("No se pudo guardar detalle para producto {$productId}.");
                }

                // 2.2) Procesa los seriales
                $serialsForThis = $allSerials[$i] ?? [];
                if (!empty($serialsForThis)) {
                    foreach ($serialsForThis as $serial) {
                        // Verificar si el serial ya existe
                        $existingSerial = $this->productsSerialsModel
                            ->where('serial', $serial)
                            ->where('inventory_product_id', $productId)
                            ->first();

                        if ($existingSerial) {
                            // Verificar si está en estado permitido para actualizar
                            $allowedStates = ['en Transito', 'Dañado'];

                            if (in_array($existingSerial['estado'], $allowedStates)) {
                                // Actualizar serial existente
                                $updateData = [
                                    'estado'                       => 'Disponible',
                                    'sede_id'                      => $sedeId,
                                    'inventory_entries_details_id' => $detailId,
                                    'inventory_exits_details_id'   => null,
                                    'updated_at'                   => date('Y-m-d H:i:s')
                                ];

                                $ok = $this->productsSerialsModel->update($existingSerial['id'], $updateData);
                                if (!$ok) {
                                    log_message('error', 'Error actualizando serial: ' . print_r($this->productsSerialsModel->errors(), true));
                                    throw new \RuntimeException("No se pudo actualizar el serial {$serial}.");
                                }
                            } else {
                                throw new \RuntimeException("El serial {$serial} ya existe y está en estado '{$existingSerial['estado']}', no se puede procesar.");
                            }
                        } else {
                            // Insertar nuevo serial
                            $serialData = [
                                'inventory_product_id'         => $productId,
                                'serial'                       => $serial,
                                'estado'                       => 'Disponible',
                                'sede_id'                      => $sedeId,
                                'inventory_entries_details_id' => $detailId,
                                'inventory_exits_details_id'   => null,
                            ];

                            $ok = $this->productsSerialsModel->insert($serialData);
                            if (!$ok) {
                                log_message('error', 'ProductsSerialModel errors: '
                                    . print_r($this->productsSerialsModel->errors(), true));
                                log_message('error', 'DB error: '
                                    . json_encode($this->db->error(), JSON_PRETTY_PRINT));
                                throw new \RuntimeException("No se pudo guardar el serial {$serial}.");
                            }
                        }
                    }
                }

                // 2.3) Actualiza stock en inventory
                if (!$this->inventoryModel->incrementStock($productId, $sedeId, $qty)) {
                    throw new \RuntimeException("No se pudo actualizar el stock para producto {$productId}.");
                }
            }

            // 3) Commit / rollback automático
            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Error en transacción, se hizo rollback.');
            }

            // 4) Respuesta
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 200,
                    'message' => 'Entrada creada exitosamente',
                    'entryId' => $entryId
                ]);
            }
            return redirect()
                ->to(base_url('inventory/entradas'))
                ->with('success', 'Entrada creada exitosamente');
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
                        'message' => 'Error al crear la entrada: ' . $e->getMessage(),
                    ]);
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            // 1) Obtener la entrada
            $entry = $this->entryModel->find($id);
            if (! $entry) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 404, 'message' => 'Entrada no encontrada']);
            }

            // 2) Obtener detalles con código y nombre de producto
            $details = $this->entriesDetailsModel
                ->select('inventory_entries_details.id, product_id, cantidad, inventory_products.codigo, inventory_products.nombre')
                ->join('inventory_products', 'inventory_products.id = inventory_entries_details.product_id')
                ->where('inventory_entry_id', $id)
                ->findAll();

            // 3) Anexar seriales a cada detalle
            foreach ($details as &$det) {
                $serials = $this->productsSerialsModel
                    ->where('inventory_entries_details_id', $det['id'])
                    ->findAll();
                $det['serials'] = array_column($serials, 'serial');
            }

            // 4) Responder JSON
            return $this->response->setJSON([
                'status'  => 200,
                'entry'   => $entry,
                'details' => $details,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error show(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al obtener la entrada: ' . $e->getMessage(),
                ]);
        }
    }

    public function delete(string $id)
    {
        // Sólo por POST y con un ID válido
        if (! $this->request->is('post') || empty($id)) {
            return redirect()->to('inventory/entries');
        }

        // Inicia transacción
        $this->db->transStart();

        // 1) Recupera todos los detalles de esta entrada
        $details = $this->entriesDetailsModel
            ->where('inventory_entry_id', $id)
            ->findAll();

        // 2) Por cada detalle, descuenta la cantidad del stock
        $sedeId = session('inventory_user')['sede_id'];
        foreach ($details as $det) {
            $prodId = $det['product_id'];
            $qty    = (int) $det['cantidad'];

            // Encuentra el registro de stock
            $stockRow = $this->inventoryModel
                ->where('product_id', $prodId)
                ->where('sede_id',    $sedeId)
                ->first();

            if ($stockRow) {
                // Calcula el nuevo stock (sin caer en negativo)
                $newStock = max(0, $stockRow['stock'] - $qty);

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

        $this->entryModel->delete($id);

        // 5) Commit / rollback
        $this->db->transComplete();
        if ($this->db->transStatus() === false) {
            log_message('error', "Error al eliminar entrada {$id}");
            return redirect()->back()->with('error', 'No se pudo eliminar la entrada.');
        }

        return redirect()
            ->to('inventory/entries')
            ->with('success', 'Entrada eliminada y stock ajustado.');
    }

    public function generatePDF(int $id)
    {

        // Configuración de mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'helvetica',
            'margin_top' => 25,
            'margin_bottom' => 15,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P'
        ]);

        $data_entries = [
            'entries' => $this->entryModel->where('id', $id)->first(),
            'details' => $this->entriesDetailsModel->where('inventory_entry_id', $id)->findAll(),
            'data' => $this->getInventoryData($id),
        ];

        // Header del PDF
        $mpdf->SetHTMLHeader($this->getHTMLHeader($data_entries));

        // Footer del PDF
        $mpdf->SetHTMLFooter($this->getHTMLFooter());

        // Generar contenido HTML
        $html = view('pdf/inventory/entradas/index', $data_entries);

        // Escribir HTML al PDF
        $mpdf->WriteHTML($html);

        // Generar nombre del archivo
        $filename = 'entrada_' . $data_entries['entries']['codigo'] . '.pdf';

        // Mostrar PDF en el navegador
        $mpdf->Output($filename, 'I');

        exit;
    }

    private function getInventoryData(int $id)
    {
        // Obtener datos de la entrada principal
        $entries = $this->entryModel
            ->select('inventory_entries.*, sedes.sucursal as sede')
            ->join('sedes', 'sedes.id = inventory_entries.sede_id')
            ->where('inventory_entries.id', $id)
            ->first();

        // Obtener detalles de los productos
        $details = $this->entriesDetailsModel
            ->select('inventory_entries_details.*, inventory_products.codigo, inventory_products.nombre, inventory_products.descripcion, inventory_products.requiere_serie')
            ->join('inventory_products', 'inventory_products.id = inventory_entries_details.product_id')
            ->where('inventory_entry_id', $id)
            ->findAll();

        // Preparar estructura de productos con seriales
        $productos = [];
        $anexoLetra = 'A'; // Comenzar con la letra A para los anexos

        foreach ($details as $index => $detalle) {
            $item = $index + 1;

            // Determinar si el producto requiere números de serie
            $requiereSerie = (bool)$detalle['requiere_serie'];

            // Obtener seriales si aplica
            $seriales = [];
            if ($requiereSerie) {
                $seriales = $this->getSerialesPorDetalle($detalle['id']);
            }

            // Construir estructura del producto
            $producto = [
                'item' => $item,
                'codigo' => $detalle['codigo'],
                'nombre' => $detalle['nombre'],
                'descripcion' => $detalle['descripcion'],
                'cantidad' => $detalle['cantidad'],
                'requiere_serie' => $requiereSerie,
                'numero_serie' => $requiereSerie ? "Ver Anexo $anexoLetra" : 'No Aplica',
                'anexo' => $requiereSerie ? $anexoLetra : null,
                'seriales' => $seriales
            ];

            $productos[] = $producto;

            // Avanzar a la siguiente letra solo si tiene seriales
            if ($requiereSerie && !empty($seriales)) {
                $anexoLetra++;
            }
        }

        // Construir respuesta final
        return [
            'id' => $entries['id'],
            'referencia' => $entries['codigo'],
            'fecha_recepcion' => $entries['fecha_recepcion'],
            'proveedor' => $entries['proveedor'],
            'tipo_descripcion' => $entries['tipo'] . ' / ' . $entries['descripcion'],
            'sede' => $entries['sede'],
            'productos' => $productos,
            'observaciones' => $entries['observacion']
        ];
    }

    private function getSerialesPorDetalle($detalleId)
    {
        $seriales = $this->productsSerialsModel
            ->select('serial, estado, sede_id, created_at')
            ->where('inventory_entries_details_id', $detalleId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $seriales;
    }

    private function getHTMLHeader($data)
    {
        return '
            <div style="width: 100%; padding: 0 20px; border-bottom: 2px solid #216E71; padding-bottom: 15px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 70%; text-align: left; vertical-align: bottom;">
                            <div style="font-size: 20pt; font-weight: bold; color: #216E71;">Reporte de Ingreso</div>
                            <div style="margin-top: 5px; font-size: 12pt;">
                                <span><strong>Referencia de Ingreso:</strong> ' . $data['entries']['codigo'] . '</span>
                            </div>
                        </td>
                        <td style="width: 30%; text-align: right; vertical-align: bottom;">
                            <img src="' . base_url('assets/media/img/encabezado.png') . '" style="height: 50px; max-width: 150px;">
                        </td>
                    </tr>
                </table>
            </div>
        ';
    }

    private function getHTMLFooter()
    {
        return '
            <div style="width: 100%; border-top: 1px solid #216E71; padding-top: 10px; font-size: 9pt; text-align: center; color: #666;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; text-align: left;">
                           
                        </td>
                        <td style="width: 50%; text-align: right;">
                            Página {PAGENO} de {nbpg}
                        </td>
                    </tr>
                </table>
            </div>
        ';
    }
}
