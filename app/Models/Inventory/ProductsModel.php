<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'inventory_products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codigo', 'nombre', 'descripcion', 'area_id', 'unidad_id', 'categoria', 'stock_min', 'stock_max', 'requiere_serie'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
