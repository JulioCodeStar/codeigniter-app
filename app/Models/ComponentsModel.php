<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentsModel extends Model
{
    protected $table            = 'components';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'id', 'job_id', 'order', 'description', 'cantidad', 'items' ];
}



?>