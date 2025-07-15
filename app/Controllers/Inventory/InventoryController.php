<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\AreaModel;
use App\Models\Inventory\InventoryModel;
use App\Models\Inventory\ProductsModel;
use App\Models\SedeModel;
use CodeIgniter\API\ResponseTrait;

class InventoryController extends BaseController
{
    use ResponseTrait;
    protected $sedeModel, $inventoryModel, $productsModel, $areaModel;

    public function __construct()
    {
        $this->sedeModel        = new SedeModel();
        $this->inventoryModel   = new InventoryModel();
        $this->productsModel    = new ProductsModel();
        $this->areaModel        = new AreaModel();
    }

    public function index()
    {
        $activeSedeId = session('inventory_user')['sede_id'];
        $activeSede = $this->sedeModel->find($activeSedeId);

        $items = $this->inventoryModel
                ->select('
                    inventory_products.codigo,
                    inventory_products.nombre,
                    inventory_products.stock_min,
                    inventory_products.stock_max,
                    inventory.stock as stock_actual,
                    areas.nombres as area
                ')
                ->join('inventory_products', 'inventory_products.id = inventory.product_id')
                ->join('areas',           'areas.id              = inventory_products.area_id')
                ->where('inventory.sede_id',   $activeSedeId)
                ->where('inventory.stock <= inventory_products.stock_min')
                ->orderBy('inventory.stock', 'ASC')
                ->findAll();

        $totalProducts = $this->productsModel->countAllResults();

        $totalStock = $this->inventoryModel
            ->select('SUM(stock) as total_stock')
            ->where('sede_id', $activeSedeId)
            ->first();

        $totalStockBajo = $this->inventoryModel
            ->select('COUNT(*) as total_stock_min')
            ->join('inventory_products', 'inventory_products.id = inventory.product_id')
            ->where('sede_id', $activeSedeId)
            ->where('stock > stock_min AND stock < stock_max')
            ->first();

        $totalStockCritico = $this->inventoryModel
            ->select('COUNT(*) as total_stock_min')
            ->join('inventory_products', 'inventory_products.id = inventory.product_id')
            ->where('sede_id', $activeSedeId)
            ->where('stock <= stock_min')
            ->first();


        $data = [
            'activeSedeId' => $activeSedeId,
            'activeSede' => $activeSede,
            'items' => $items,
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock['total_stock'],
            'totalStockBajo' => $totalStockBajo['total_stock_min'],
            'totalStockCritico' => $totalStockCritico['total_stock_min'],
        ];
        return view('inventory/index', $data);
    }

    public function changeSede($sedeId)
    {
        $user = session('inventory_user');
        $user['sede_id'] = $sedeId;
        session()->set('inventory_user', $user);

        return redirect()->to('inventory');
    }
}
