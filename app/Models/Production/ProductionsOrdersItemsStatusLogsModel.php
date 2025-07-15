<?php

namespace App\Models\Production;

use CodeIgniter\Model;

class ProductionsOrdersItemsStatusLogsModel extends Model
{
    protected $table            = 'production_orders_items_status_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['production_order_item_id', 'estado', 'notas', 'usuario', 'created_at'];

    protected bool $allowEmptyInserts = false;

}
