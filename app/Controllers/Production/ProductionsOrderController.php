<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\Production\ProductionsOrdersItemsModel;
use App\Models\Production\ProductionsOrdersItemsStatusLogsModel;
use App\Models\Production\ProductionsOrdersItemsUnidModel;
use App\Models\Production\ProductionsOrdersModel;
use App\Models\Production\ProductionsProductsModel;

class ProductionsOrderController extends BaseController
{
    protected $orderModel, $patientModel, $productModel, $orderItemsUnidModel, $orderItemsModel, $orderItemsStatusLogsModel;

    public function __construct()
    {
        $this->orderModel   = new ProductionsOrdersModel();
        $this->patientModel = new PatientModel();
        $this->productModel = new ProductionsProductsModel();
        $this->orderItemsUnidModel = new ProductionsOrdersItemsUnidModel();
        $this->orderItemsModel = new ProductionsOrdersItemsModel();
        $this->orderItemsStatusLogsModel = new ProductionsOrdersItemsStatusLogsModel();
    }

    public function index()
    {
        $area = session('production_user')['area'];

        // 1) traigo las órdenes de producción
        $ordenes = $this->orderModel
            ->where('area_respon', $area)
            ->orderBy('id', 'DESC')
            ->findAll();

        // 2) obtengo todos los items de esas órdenes (solo si hay órdenes)
        $ordenIds = array_column($ordenes, 'id');
        if (! empty($ordenIds)) {
            $items = $this->orderItemsModel
                ->whereIn('production_order_id', $ordenIds)
                ->findAll();
        } else {
            $items = [];
        }

        // 3) obtengo todas las unidades (códigos) de esos items (solo si hay items)
        $itemIds = array_column($items, 'id');
        if (! empty($itemIds)) {
            $codes = $this->orderItemsUnidModel
                ->whereIn('production_order_item_id', $itemIds)
                ->findAll();
        } else {
            $codes = [];
        }

        // 4) agrupo items por orden_id
        $itemsByOrden = [];
        foreach ($items as $it) {
            $itemsByOrden[$it['production_order_id']][] = $it;
        }

        // 5) agrupo códigos por item_id
        $codesByItem = [];
        foreach ($codes as $c) {
            $codesByItem[$c['production_order_item_id']][] = [
                'code'           => $c['numero_serie_production'],
                'especificacion' => $c['especificaciones'],  // el campo de la tabla unidades
            ];
        }

        // 6) enriquecer cada orden con su lista de items (y de códigos)
        foreach ($ordenes as &$ord) {
            $ord['items'] = [];
            if (isset($itemsByOrden[$ord['id']])) {
                foreach ($itemsByOrden[$ord['id']] as $it) {
                    $ord['items'][] = [
                        'producto_id'      => $it['production_producto_id'],
                        'cantidad'         => $it['cantidad'],
                        'especificaciones' => $it['especificaciones'],
                        'estado'           => $it['estado'],
                        'codigos'          => $codesByItem[$it['id']] ?? []
                    ];
                }
            }
        }
        unset($ord);

        // 7) mapas auxiliares para pacientes (solo si hay pacientes válidos)
        $pacienteIds = array_filter(array_column($ordenes, 'paciente_id'));
        if (! empty($pacienteIds)) {
            $pacientesDatos = $this->patientModel
                ->whereIn('id', $pacienteIds)
                ->findAll();
        } else {
            $pacientesDatos = [];
        }
        $mapPacientes = array_column($pacientesDatos, null, 'id');

        // 8) mapa de productos (por área, no usa whereIn)
        $productosDatos = $this->productModel
            ->where('area', $area)
            ->orderBy('id', 'DESC')
            ->findAll();
        $mapProductos = array_column($productosDatos, null, 'id');

        $patients = $this->patientModel->orderBy('cod_paciente', 'DESC')->findAll();
        $products = $this->productModel->where('area', $area)->orderBy('id', 'DESC')->findAll();

        return view('production/order/index', [
            'ordenes'       => $ordenes,
            'mapPacientes'  => $mapPacientes,
            'mapProductos'  => $mapProductos,
            'patients'      => $patients,
            'products'      => $products,
        ]);
    }


    public function previewSerials()
    {
        $productId = (int)$this->request->getPost('product_id');
        $qty       = (int)$this->request->getPost('quantity');

        $serials = $this->orderItemsUnidModel->generateNextSerialsByProduct($productId, $qty);

        return $this->response->setJSON([
            'serials' => $serials
        ]);
    }

    public function create()
    {
        try {
            $post = $this->request->getPost();

            $data = [
                'tip_orden'         => $post['type_order'],
                'paciente_id'       => $post['patient_id'] ?? null,
                'nombre_externo'    => $post['input_field'] ?? null,
                'area_respon'       => $post['area_respon'],
                'fecha_solicitud'   => $post['fecha_solicitud'],
                'fecha_entrega'     => $post['fecha_entrega'],
                'notas'             => $post['notas'] ?? null,
            ];

            $production_order = $this->orderModel->insert($data, true);

            if ($production_order) {
                $order_items = $post['items'] ?? [];
                if (is_string($order_items)) {
                    $decoded = json_decode($order_items, true);
                    // Si falla el JSON, forzar a array vacío
                    $order_items = is_array($decoded) ? $decoded : [];
                }

                // 3) Insertar cada ítem si hay orden y items
                if ($production_order && is_array($order_items)) {
                    foreach ($order_items as $item) {
                        $itemId = $this->orderItemsModel->insert([
                            'production_order_id'   => $production_order,
                            'production_producto_id' => (int) $item['id'],
                            'cantidad'              => (int) $item['cantidad'],
                            'especificaciones'      => $item['especificaciones'] ?? null,
                        ], true);

                        foreach ($item['codigos'] as $unit) {
                            $this->orderItemsUnidModel->insert([
                                'production_order_item_id' => $itemId,
                                'numero_serie_production'  => $unit['code'],
                                'especificaciones'         => $unit['especificacion'],
                            ]);
                        }

                        $this->orderItemsStatusLogsModel->insert([
                            'production_order_item_id' => $itemId,
                            'estado'                   => 'pendiente',
                            'usuario'                  => session('production_user')['nombre'],
                            'created_at'               => date('Y-m-d H:i:s'),
                            'notas'                    => 'Orden creada',
                        ]);
                    }
                }
            }

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Orden de Producción Registrada Exitosamente',
                        'redirect' => 'production/orders'
                    ]);
            }

            return redirect()
                ->to('production/orders')
                ->with('success', 'Orden de Producción Registrada Exitosamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al crear Orden de Producción: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear Orden de Producción',
                        'code' => $e->getMessage()
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $this->orderModel->delete($id);
            return redirect()->to('production/orders')->with('success', 'Orden de Producción Eliminada Exitosamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al eliminar Orden de Producción: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar Orden de Producción: ' . $e->getMessage());
        }
    }
}
