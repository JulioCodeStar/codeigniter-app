<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\Production\ProductionsOrdersItemsModel;
use App\Models\Production\ProductionsOrdersItemsUnidModel;
use App\Models\Production\ProductionsOrdersModel;
use App\Models\Production\ProductionsProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductionsController extends BaseController
{
    protected $productModel, $orderModel, $itemsUnidModel, $orderItemModel;

    public function __construct()
    {
        $this->productModel = new ProductionsProductsModel();
        $this->orderModel = new ProductionsOrdersModel();
        $this->itemsUnidModel = new ProductionsOrdersItemsUnidModel();
        $this->orderItemModel = new ProductionsOrdersItemsModel();
    }

    public function index()
    {
        $products = $this->productModel->where('area', session('production_user')['area'])->countAllResults();
        $orders = $this->orderModel->where('area_respon', session('production_user')['area'])->countAllResults();
        $series = $this->countSerie();

        /* Tipo de Orden */
        $countPatient = $this->countTypeOrder('Paciente');
        $countProject = $this->countTypeOrder('Proyecto');
        $countTest = $this->countTypeOrder('Prueba');
        $countStock = $this->countTypeOrder('Stock');

        /* Tipo de Estado */
        $countPending = $this->countTypeStatus('pendiente');
        $countProduction = $this->countTypeStatus('en producción');
        $countAssembly = $this->countTypeStatus('ensambladando');
        $countCompleted = $this->countTypeStatus('terminado');
        $countDelivered = $this->countTypeStatus('entregado');

        /* Ordenes por fecha */
        $ordersDueToday = $this->getOrdersDueToday();
        $overdueOrders = $this->getOverdueOrders();

        return view('production/index', compact('products', 'orders', 'series', 'countPatient', 'countProject', 'countTest', 'countStock', 'countPending', 'countProduction', 'countAssembly', 'countCompleted', 'countDelivered', 'ordersDueToday', 'overdueOrders'));
    }

    protected function countSerie()
    {
        $area = session('production_user')['area'];

        // Contar series por área
        $result = $this->itemsUnidModel
            ->select('COUNT(*) as total_series')
            ->join('production_orders_items', 'production_orders_items.id = production_orders_items_unidades.production_order_item_id')
            ->join('production_orders', 'production_orders.id = production_orders_items.production_order_id')
            ->where('production_orders.area_respon', $area)
            ->get()
            ->getRow();

        return $result ? $result->total_series : 0;
    }

    protected function countTypeOrder(string $type)
    {
        $area = session('production_user')['area'];

        // Contar series por área
        $result = $this->orderModel
            ->where('area_respon', $area)
            ->where('tip_orden', $type)
            ->countAllResults();

        return $result;
    }

    protected function countTypeStatus(string $status)
    {
        $area = session('production_user')['area'];

        // Contar pedidos por área y estado
        $result = $this->orderModel
            ->select('COUNT(DISTINCT production_orders.id) as total')
            ->join('production_orders_items i', 'i.production_order_id = production_orders.id', 'left')
            ->where('production_orders.area_respon', $area)
            ->where('i.estado', $status)
            ->get()
            ->getRowArray();

        return $result['total'] ?? 0;
    }

    protected function getOrdersDueToday()
    {
        $area  = session('production_user')['area'];
        $today = date('Y-m-d');

        return $this->orderModel
            ->select([
                'production_orders.*',
                'p.nombres           AS paciente_nombre',
                'p.apellidos         AS paciente_apellidos',
                'oi.cantidad         AS item_cantidad',
                'oi.estado           AS item_estado',
                'pr.nombre           AS producto_nombre',
            ])
            ->join('pacientes p',               'p.id    = production_orders.paciente_id',       'left')
            ->join('production_orders_items oi', 'oi.production_order_id = production_orders.id', 'left')
            ->join('production_products pr',    'pr.id   = oi.production_producto_id',           'left')
            ->where('production_orders.area_respon', $area)
            ->where('DATE(production_orders.fecha_entrega)', $today)
            ->where('production_orders.estado !=', 'terminado')
            ->orderBy('production_orders.fecha_entrega', 'ASC')
            ->findAll();
    }


    protected function getOverdueOrders()
    {
        $area = session('production_user')['area'];
        $today = date('Y-m-d');

        return $this->orderModel
            ->select([
                'production_orders.*',
                'p.nombres           AS paciente_nombre',
                'p.apellidos         AS paciente_apellidos',
                'oi.cantidad         AS item_cantidad',
                'oi.estado           AS item_estado',
                'pr.nombre           AS producto_nombre',
            ])
            ->join('pacientes p',               'p.id    = production_orders.paciente_id',       'left')
            ->join('production_orders_items oi', 'oi.production_order_id = production_orders.id', 'left')
            ->join('production_products pr',    'pr.id   = oi.production_producto_id',           'left')
            ->where('production_orders.area_respon', $area)
            ->where('DATE(production_orders.fecha_entrega) <', $today)
            ->where('production_orders.estado !=', 'terminado')
            ->orderBy('production_orders.fecha_entrega', 'ASC')
            ->findAll();
    }
}
