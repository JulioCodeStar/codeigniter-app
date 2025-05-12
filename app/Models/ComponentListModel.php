<?php

namespace App\Models;

use CodeIgniter\Model;

class ComponentListModel extends Model
{
    protected $table            = 'componentes_list';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'id', 'component_id', 'itema' ];
}



?>