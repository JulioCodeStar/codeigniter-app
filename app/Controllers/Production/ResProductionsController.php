<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\Production\ProductionsOrdersItemsModel;
use App\Models\Production\ProductionsOrdersItemsUnidModel;
use App\Models\Production\ProductionsOrdersModel;
use App\Models\Production\ProductionsProductsModel;
use App\Models\Production\ProductionsOrdersItemsLogModel;
use App\Models\Production\ProductionsOrdersItemsStatusLogsModel;

class ResProductionsController extends BaseController
{
    protected $productModel, $orderModel, $orderItemModel, $orderItemUnidModel, $orderItemLogModel;

    protected $areas = [
        'produccion'   => 'Producción',
        'textil'       => 'Textil',
        'desarrollo'   => 'Desarrollo Tecnológico',
    ];

    protected $stateMap = [
        'pendiente'     => 'warning',
        'en producción' => 'primary',
        'ensamblaje'    => 'primary',
        'listo'         => 'success',
        'entregado'     => 'success',
    ];

    public function __construct()
    {
        $this->productModel         = new ProductionsProductsModel();
        $this->orderModel           = new ProductionsOrdersModel();
        $this->orderItemModel       = new ProductionsOrdersItemsModel();
        $this->orderItemUnidModel   = new ProductionsOrdersItemsUnidModel();
        $this->orderItemLogModel    = new ProductionsOrdersItemsStatusLogsModel();
    }

    public function index()
    {
        $stats = [];

        foreach ($this->areas as $key => $name) {
            // 1. Totales de productos y órdenes como antes
            $products = $this->productModel
                ->where('area', $name)
                ->countAllResults();
            $orders   = $this->orderModel
                ->where('area_respon', $name)
                ->countAllResults();

            // 2. Conteos por estado (JOIN con orders_items)
            $rows = $this->orderItemModel
                ->select('production_orders_items.estado, COUNT(*) AS total')
                ->join('production_orders o', 'o.id = production_orders_items.production_order_id')
                ->where('o.area_respon', $name)
                ->groupBy('production_orders_items.estado')
                ->findAll();

            // 3. Inicializamos todos en cero y luego llenamos
            $stateCounts = array_fill_keys(array_keys($this->stateMap), 0);
            foreach ($rows as $r) {
                $stateCounts[$r['estado']] = $r['total'];
            }

            $stats[] = [
                'key'          => $key,
                'name'         => $name,
                'products'     => $products,
                'orders'       => $orders,
                'stateCounts'  => $stateCounts,
            ];
        }

        /* Pedidos de Hoy y Atrasados */
        $hoy = date('Y-m-d');

        $baseSelect = '
            production_orders.*,
            p.nombres           AS paciente_nombre,
            p.apellidos         AS paciente_apellidos,
            production_orders.nombre_externo
        ';

        $ordersDueToday = $this->orderModel
            ->select($baseSelect)
            ->join('pacientes p', 'p.id = production_orders.paciente_id', 'left')
            ->where('DATE(production_orders.fecha_entrega)', $hoy)
            ->where('production_orders.estado !=', 'terminado')
            ->orderBy('production_orders.fecha_entrega', 'ASC')
            ->findAll();

        $ordersOverdue = $this->orderModel
            ->select($baseSelect)
            ->join('pacientes p', 'p.id = production_orders.paciente_id', 'left')
            ->where('DATE(production_orders.fecha_entrega) <', $hoy)
            ->where('production_orders.estado !=', 'terminado')
            ->orderBy('production_orders.fecha_entrega', 'ASC')
            ->findAll();

        // 3) Cargar items para cada orden
        foreach (['ordersDueToday', 'ordersOverdue'] as $var) {
            foreach ($$var as &$order) {
                $items = $this->orderItemModel
                    ->select('
                    production_orders_items.id,
                    production_orders_items.cantidad,
                    production_orders_items.estado,
                    pr.nombre AS producto_nombre
                ', false)
                    ->join(
                        'production_products pr',
                        'pr.id = production_orders_items.production_producto_id',
                        'left'
                    )
                    ->where('production_orders_items.production_order_id', $order['id'])
                    ->findAll();

                foreach ($items as &$item) {
                    $units = $this->orderItemUnidModel
                        ->where('production_order_item_id', $item['id'])
                        ->findAll();
                    $item['units']    = $units;
                    // Opcional: si quieres mostrar la cantidad real:
                    $item['cantidad'] = count($units);
                }
                unset($item);

                $order['items'] = $items;
            }
            unset($order);
        }

        $allOrders = $this->orderModel
            ->select('production_orders.*, p.nombres AS paciente_nombre, p.apellidos AS paciente_apellidos, production_orders.nombre_externo, production_orders.codigo')
            ->join('pacientes p', 'p.id = production_orders.paciente_id', 'left')
            ->orderBy('production_orders.fecha_entrega', 'ASC')
            ->findAll();

        foreach ($allOrders as &$order) {
            $items = $this->orderItemModel
                ->select('production_orders_items.id, production_orders_items.cantidad, production_orders_items.estado, pr.nombre AS producto_nombre', false)
                ->join('production_products pr', 'pr.id = production_orders_items.production_producto_id', 'left')
                ->where('production_orders_items.production_order_id', $order['id'])
                ->findAll();

            foreach ($items as &$item) {
                $units = $this->orderItemUnidModel
                    ->where('production_order_item_id', $item['id'])
                    ->findAll();
                $item['units']    = $units;
                $item['cantidad'] = count($units);
            }
            unset($item);

            $order['items'] = $items;
        }
        unset($order);

        // Traer todos los ítems del área (para búsqueda)
        $allItems = $this->orderItemModel
            ->select("
                production_orders_items.id,
                GROUP_CONCAT(un.numero_serie_production SEPARATOR ', ') AS item_codigo,
                production_orders_items.estado   AS item_estado,
                pr.nombre                        AS producto_nombre,
                o.paciente_id,
                p.nombres                        AS paciente_nombre,
                p.apellidos                      AS paciente_apellidos,
                o.tip_orden                      AS tip_orden,
                o.area_respon                    AS area_respon,
                o.notas                          AS notas,
                o.nombre_externo
            ", false)
            ->join('production_products pr',  'pr.id = production_orders_items.production_producto_id',        'left')
            ->join('production_orders o',      'o.id = production_orders_items.production_order_id',            'left')
            ->join('pacientes p',              'p.id = o.paciente_id',                                           'left')
            ->join(
                'production_orders_items_unidades un',
                'un.production_order_item_id = production_orders_items.id',
                'left'
            )
            ->groupBy('production_orders_items.id')
            ->orderBy('production_orders_items.id', 'ASC')
            ->findAll();


        // Para cada ítem, carga su lista de unidades y calcula cantidad
        foreach ($allItems as &$item) {
            $units = $this->orderItemUnidModel
                ->where('production_order_item_id', $item['id'])
                ->findAll();

            $item['units']    = $units;
            $item['cantidad'] = count($units);

            $rows = $this->orderItemLogModel
                ->where('production_order_item_id', $item['id'])
                ->orderBy('created_at', 'ASC')
                ->findAll();

            // 2) Transformo al formato que usa la vista
            $history = [];
            foreach ($rows as $r) {
                $history[] = [
                    'estado' => $r['estado'],
                    'fecha'  => date('Y-m-d', strtotime($r['created_at'])),
                    'actor'  => $r['usuario'],   // aquí el nombre del usuario
                    'nota'   => $r['notas'],
                ];
            }

            $item['history'] = $history;
        }
        unset($item);

        return view('production/res-productions/index', [
            'stats'    => $stats,
            'stateMap' => $this->stateMap,
            'ordersDueToday'   => $ordersDueToday,
            'ordersOverdue'    => $ordersOverdue,
            'allOrders'        => $allOrders,
            'allItems'         => $allItems,
        ]);
    }
}
