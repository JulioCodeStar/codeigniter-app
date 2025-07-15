<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\AreaModel;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductsModel;
use App\Models\Inventory\ProductsSerialsModel;
use App\Models\SedeModel;
use CodeIgniter\HTTP\ResponseInterface;

class StockController extends BaseController
{
    protected $sedesModel, $productModel, $inventoryModel, $areaModel, $db, $productSerialsModel;

    public function __construct()
    {
        $this->sedesModel           = new SedeModel();
        $this->productModel         = new ProductsModel();
        $this->inventoryModel       = new InventoryModel();
        $this->areaModel            = new AreaModel();
        $this->db                   = \Config\Database::connect();
        $this->productSerialsModel  = new ProductsSerialsModel();
    }

    public function index()
    {
        // Sedes permitidas para este usuario
        $userSedes = session('inventory_user')['sedes'];
        // Áreas (para el filtro)
        $areas     = $this->areaModel->findAll();
        // Tu consulta de stock
        $stocks    = $this->inventoryModel
            ->select('inventory_products.*, inventory.stock, inventory_products.stock_min, inventory_products.stock_max, inventory_products.area_id, areas.nombres AS area, sedes.sucursal as sede, sedes.id as sede_id')
            ->join('inventory_products', 'inventory_products.id = inventory.product_id')
            ->join('areas',            'areas.id = inventory_products.area_id')
            ->join('sedes',            'sedes.id = inventory.sede_id')
            ->whereIn('inventory.sede_id', array_column($userSedes, 'sede_id'))
            ->findAll();

        return view('inventory/stock/index', compact('stocks', 'areas', 'userSedes'));
    }

    public function show($id = null)
    {
        try {
            $sedeId = session('inventory_user')['sede_id'];

            // 1) Producto + área + stock + sede
            $product = $this->productModel
                ->select('
                inventory_products.id,
                inventory_products.codigo,
                inventory_products.nombre,
                inventory_products.descripcion,
                areas.nombres     AS area_nombre,
                inventory.stock,
                inventory_products.stock_min,
                inventory_products.stock_max,
                sedes.sucursal    AS sede
            ')
                ->join('areas',     'areas.id = inventory_products.area_id')
                ->join('inventory', "inventory.product_id = inventory_products.id AND inventory.sede_id = {$sedeId}")
                ->join('sedes',     'sedes.id = inventory.sede_id')
                ->find($id);

            if (! $product) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 404, 'message' => 'Producto no encontrado']);
            }

            // 2) Series disponibles
            $serials = $this->productSerialsModel
                ->where('inventory_product_id', $id)
                ->where('sede_id',              $sedeId)
                ->where('estado',               'Disponible')
                ->findAll();
            $listSerials = array_column($serials, 'serial');

            // 3) Movimientos: Entradas ↔ Salidas, trayendo fecha_recepcion / fecha_salida
            $entries = $this->db->table('inventory_entries_details d')
                ->select(' e.codigo  AS doc,
                       "Entrada" AS tipo,
                       d.cantidad,
                       e.fecha_recepcion AS fecha ')
                ->join('inventory_entries e', 'e.id = d.inventory_entry_id')
                ->where('d.product_id', $id)
                ->where('e.sede_id',     $sedeId);

            $exits = $this->db->table('inventory_exits_details d')
                ->select(' x.codigo    AS doc,
                       "Salida"   AS tipo,
                       d.cantidad,
                       x.fecha_salida   AS fecha ')
                ->join('inventory_exits x', 'x.id = d.inventory_exit_id')
                ->where('d.inventory_product_id', $id)
                ->where('x.sede_id',              $sedeId);

            $movements = $entries
                ->union($exits)
                ->orderBy('fecha', 'DESC')
                ->get()
                ->getResultArray();

            // 4) Responder JSON
            return $this->response->setJSON([
                'status'    => 200,
                'product'   => $product,
                'serials'   => $listSerials,
                'movements' => $movements,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'StockController::show error: ' . $e->getMessage());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['status' => 500, 'message' => 'Error al obtener detalles: ' . $e->getMessage()]);
        }
    }
}
