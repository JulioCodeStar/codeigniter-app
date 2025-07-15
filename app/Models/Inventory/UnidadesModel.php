<?php

namespace App\Models\Inventory;

use CodeIgniter\Model;

class UnidadesModel extends Model
{
    protected $table            = 'unidades';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombres', 'abreviatura'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}
