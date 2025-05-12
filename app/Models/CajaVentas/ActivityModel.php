<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'actividad_reciente';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'movimiento_id', 'accion', 'descripcion', 'created_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;

}
