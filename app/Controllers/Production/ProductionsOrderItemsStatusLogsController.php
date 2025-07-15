<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\PatientModel;
use App\Models\Production\ProductionsOrdersItemsModel;
use App\Models\Production\ProductionsOrdersItemsStatusLogsModel;
use App\Models\Production\ProductionsOrdersItemsUnidModel;
use App\Models\Production\ProductionsOrdersModel;
use App\Models\Production\ProductionsProductsModel;

class ProductionsOrderItemsStatusLogsController extends BaseController
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

        // 1) Traer todas las órdenes de producción de mi área
        $ordenes    = $this->orderModel
            ->where('area_respon', $area)
            ->orderBy('id', 'DESC')
            ->findAll();

        // 2) Con esos IDs, traer los ítems
        $ordenIds = array_column($ordenes, 'id');
        if (! empty($ordenIds)) {
            $items = $this->orderItemsModel
                ->whereIn('production_order_id', $ordenIds)
                ->findAll();
        } else {
            $items = [];
        }

        // 3) Con los IDs de ítems, traer las unidades (seriales)
        $itemIds = array_column($items, 'id');
        if (! empty($itemIds)) {
            $unidades = $this->orderItemsUnidModel
                ->whereIn('production_order_item_id', $itemIds)
                ->findAll();
        } else {
            $unidades = [];
        }

        // 4) Agrupar unidades por item_id
        $serialsByItem = [];
        foreach ($unidades as $u) {
            $serialsByItem[$u['production_order_item_id']][] = [
                'code'           => $u['numero_serie_production'],
                'especificacion' => $u['especificaciones'],  // el campo de tu tabla
            ];
        }

        $lastLogByItem = [];
        foreach ($itemIds as $iid) {
            $lastLogByItem[$iid] = $this->orderItemsStatusLogsModel
                ->where('production_order_item_id', $iid)
                ->orderBy('created_at', 'DESC')
                ->first();
        }

        // 5) Construir el array final de ítems enriquecido
        $itemsByOrden = [];
        foreach ($items as $it) {
            $itemsByOrden[$it['production_order_id']][] = [
                'item_id'           => $it['id'],
                'producto_id'       => $it['production_producto_id'],
                'cantidad'          => $it['cantidad'],
                'especificaciones'  => $it['especificaciones'],
                'estado'            => $it['estado'],
                'serials'           => $serialsByItem[$it['id']] ?? [],
                'last_log'          => $lastLogByItem[$it['id']] ?? null,
            ];
        }

        // 6) Adjuntar esos ítems a cada orden
        foreach ($ordenes as &$ord) {
            $ord['items'] = $itemsByOrden[$ord['id']] ?? [];
        }
        unset($ord);

        // 7) Mapa de pacientes
        $patientIds = array_filter(array_column($ordenes, 'paciente_id'));
        $patients = $patientIds
            ? $this->patientModel->whereIn('id', $patientIds)->findAll()
            : [];
        $mapPacientes = array_column($patients, null, 'id');

        // 8) Mapa de productos
        $products = $this->productModel
            ->where('area', $area)
            ->findAll();
        $mapProductos = array_column($products, null, 'id');

        return view('production/seguimiento/index', [
            'ordenes'       => $ordenes,
            'mapPacientes'  => $mapPacientes,
            'mapProductos'  => $mapProductos,
        ]);
    }

    public function logs(int $itemId)
    {
        // cargamos el ítem para datos generales
        $item = $this->orderItemsModel
            ->select('production_orders_items.id AS item_id, production_products.nombre AS product_name, 
                     production_orders.paciente_id, production_orders.nombre_externo')
            ->join('production_products', 'production_products.id=production_orders_items.production_producto_id')
            ->join('production_orders', 'production_orders.id=production_orders_items.production_order_id')
            ->where('production_orders_items.id', $itemId)
            ->first();

        if (! $item) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => 'Ítem no encontrado']);
        }

        // obtenemos el nombre del destinatario (paciente o nombre_externo)
        if ($item['paciente_id']) {
            // si hay paciente_id, cargamos el paciente
            $paciente = $this->patientModel
                ->find($item['paciente_id']);
            $recipientName = $paciente
                ? $paciente['nombres'] . ' ' . $paciente['apellidos']
                : '—';
        } else {
            // si no hay paciente, usamos nombre_externo
            $recipientName = $item['nombre_externo'] ?? '—';
        }

        // obtenemos todos los números de serie
        $series = $this->orderItemsUnidModel
            ->select('numero_serie_production, especificaciones')
            ->where('production_order_item_id', $itemId)
            ->orderBy('id', 'ASC')
            ->findAll();

        // formateamos los números de serie para mostrarlos en el modal
        $seriesList = array_map(function ($s) {
            return $s['numero_serie_production'] . ($s['especificaciones'] ? ' (' . $s['especificaciones'] . ')' : '');
        }, $series);

        // si no hay series, mostramos 'No aplica'
        $seriesText = !empty($seriesList) ? implode(', ', $seriesList) : 'No aplica';

        // traemos el historial
        $logs = $this->orderItemsStatusLogsModel->where('production_order_item_id', $itemId)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'item' => [
                'nombre'       => $item['product_name'],
                'paciente'     => $recipientName,
                'serie_principal' => $seriesText
            ],
            'logs' => array_map(function ($l) {
                return [
                    'estado'     => $l['estado'],
                    'notas'      => $l['notas'],
                    'usuario'    => $l['usuario'],
                    'created_at' => fecha_dmy($l['created_at']),
                ];
            }, $logs)
        ]);
    }

    public function updateStatus()
    {
        $post = $this->request->getPost();
        $itemId = (int)$post['item_id'];
        $data = [
            'production_order_item_id' => $itemId,
            'estado'                   => $post['new_state'],
            'notas'                    => $post['csNota'],
            'usuario'                  => $post['csResponsable'],
            'created_at'               => date('Y-m-d H:i:s'),
        ];
        $this->orderItemsStatusLogsModel->insert($data);

        $this->orderItemsModel
            ->update($itemId, ['estado' => $post['new_state']]);

        if ($post['new_state'] === 'entregado') {
            $orderId = $this->orderItemsModel->select('production_order_id')->where('id', $itemId)->first();
            $this->orderModel->update($orderId['production_order_id'], ['estado' => 2]);
        }

        return $this->response
            ->setStatusCode(200)
            ->setJSON(['message' => 'Estado actualizado']);
    }

    public function pdfRecepcion(int $itemId)
    {
        // 1) Configuración básica de mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 35,
            'margin_bottom' => 30,
            'margin_left'   => 0,
            'margin_right'  => 0,
            'margin_header' => 10,
            'margin_footer' => 5,
        ]);

        $item = $this->orderItemsModel
            ->select('
            production_orders_items.id AS item_id,
            production_products.nombre AS product_name,
            production_orders.paciente_id,
            production_orders.nombre_externo,
            production_orders.codigo,
            production_orders.area_respon
        ')
            ->join('production_products', 'production_products.id = production_orders_items.production_producto_id')
            ->join('production_orders',   'production_orders.id   = production_orders_items.production_order_id')
            ->where('production_orders_items.id', $itemId)
            ->first();

        // 3) Fecha de recepción: buscamos el log más reciente con estado "entregado"
        $receptionLog = $this->orderItemsStatusLogsModel
            ->where('production_order_item_id', $itemId)
            ->where('estado', 'entregado')
            ->orderBy('created_at', 'DESC')
            ->first();

        $receptionDate = $receptionLog
            ? fecha_dmy($receptionLog['created_at'])
            : '—';

        // 4) Lista de números de serie y sus especificaciones
        //    (asumo que tienes un modelo OrderItemSerialsModel y en la tabla campos 'serial' y 'specs')
        $serials = $this->orderItemsUnidModel
            ->where('production_order_item_id', $itemId)
            ->findAll();

        $serialCount = count($serials);

        // 5) Cabecera, footer y marca de agua (igual que antes)
        $mpdf->SetHTMLHeader("
            <div style='text-align: center;'>
                <img src='" . base_url('assets/media/img/limp-logo.png') . "' style='width:15%;' />
            </div>
        ");
        $mpdf->SetHTMLFooter("
            <div style='position:fixed;bottom:0;left:0;width:100%;margin:0;padding:0;'>
                <img src='" . base_url('assets/media/img/footer-limp.jpg') . "' style='width:100%;height:auto;' />
            </div>
        ");
        $mpdf->SetWatermarkImage(base_url('assets/media/img/watermark.png'), 1, array(50, 130), array(157, 130));
        $mpdf->showWatermarkImage = true;

        // 6) Generamos la vista con todos los datos
        $html = view('pdf/seguimiento/letterhead_body', [
            'product_name'    => $item['product_name'],
            'recipient_name'  => $item['paciente_id'] ? $item['paciente_id'] : $item['nombre_externo'],
            'reception_date'  => $receptionDate,
            'serial_count'    => $serialCount,
            'serials'         => $serials,
            'codigo'          => $item['codigo'],
            'area'            => $item['area_respon'],
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('recepcion.pdf', 'I');
        exit;
    }

    public function pdfLiberacion(int $itemId)
    {
        // 1) Configuración básica de mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4',
            'margin_top'    => 35,
            'margin_bottom' => 30,
            'margin_left'   => 0,
            'margin_right'  => 0,
            'margin_header' => 10,
            'margin_footer' => 5,
        ]);

        $item = $this->orderItemsModel
            ->select('
            production_orders_items.id AS item_id,
            production_products.nombre AS product_name,
            production_orders.paciente_id,
            production_orders.nombre_externo,
            production_orders.codigo,
            production_orders.area_respon
        ')
            ->join('production_products', 'production_products.id = production_orders_items.production_producto_id')
            ->join('production_orders',   'production_orders.id   = production_orders_items.production_order_id')
            ->where('production_orders_items.id', $itemId)
            ->first();

        // 3) Fecha de recepción: buscamos el log más reciente con estado "entregado"
        $receptionLog = $this->orderItemsStatusLogsModel
            ->where('production_order_item_id', $itemId)
            ->where('estado', 'entregado')
            ->orderBy('created_at', 'DESC')
            ->first();

        $receptionDate = $receptionLog
            ? fecha_dmy($receptionLog['created_at'])
            : '—';

        // 4) Lista de números de serie y sus especificaciones
        //    (asumo que tienes un modelo OrderItemSerialsModel y en la tabla campos 'serial' y 'specs')
        $serials = $this->orderItemsUnidModel
            ->where('production_order_item_id', $itemId)
            ->findAll();

        $serialCount = count($serials);

        $mpdf->SetHTMLHeader("
            <div style='text-align: center;'>
                <img src='" . base_url('assets/media/img/limp-logo.png') . "' style='width:15%;' />
            </div>
        ");
        $mpdf->SetHTMLFooter("
            <div style='position:fixed;bottom:0;left:0;width:100%;margin:0;padding:0;'>
                <img src='" . base_url('assets/media/img/footer-limp.jpg') . "' style='width:100%;height:auto;' />
            </div>
        ");
        $mpdf->SetWatermarkImage(base_url('assets/media/img/watermark.png'), 1, array(50, 130), array(157, 130));
        $mpdf->showWatermarkImage = true;

        $html = view('pdf/seguimiento/letterhead_deliveracion', [
            'product_name'    => $item['product_name'],
            'recipient_name'  => $item['paciente_id'] ? $item['paciente_id'] : $item['nombre_externo'],
            'reception_date'  => $receptionDate,
            'serial_count'    => $serialCount,
            'serials'         => $serials,
            'codigo'          => $item['codigo'],
            'area'            => $item['area_respon'],
        ]);

        $mpdf->WriteHTML($html);
        $mpdf->Output('liberacion.pdf', 'I');
        exit;
    }
}
