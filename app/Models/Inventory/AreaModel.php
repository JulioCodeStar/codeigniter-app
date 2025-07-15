<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table            = 'areas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombres'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}
