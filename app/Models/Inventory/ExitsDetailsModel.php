<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class ExitsDetailsModel extends Model
{
    protected $table            = 'inventory_exits_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['inventory_exit_id', 'inventory_product_id', 'cantidad'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

}
