<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class CajaModel extends Model
{
    protected $table            = 'cajas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'sede_id', 'hora_apertura', 'hora_cierre', 'estado'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = false;

}
