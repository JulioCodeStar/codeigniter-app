<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class TrasladosDetailsModel extends Model
{
    protected $table            = 'inventory_traslados_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'traslado_id',
        'producto_id',
        'cantidad',
        'inventory_exits_details_id',
        'inventory_entries_details_id'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}
