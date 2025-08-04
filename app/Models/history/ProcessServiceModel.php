<?php

namespace App\Models\History;

use CodeIgniter\Model;

class ProcessServiceModel extends Model
{
    protected $table            = 'history_process_services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['service_id', 'nombre', 'order'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

}
