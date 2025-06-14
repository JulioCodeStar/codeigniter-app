<?php

namespace App\Models;

use CodeIgniter\Model;

class CajaVentasModel extends Model
{
    protected $table            = 'caja_accesos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'sede_id', 'is_active', 'created_at'];

    protected bool $allowEmptyInserts = false;

}
