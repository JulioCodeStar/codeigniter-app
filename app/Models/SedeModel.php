<?php

namespace App\Models;

use CodeIgniter\Model;

class SedeModel extends Model
{
    protected $table            = 'sedes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sucursal', 'descripcion'];

    protected bool $allowEmptyInserts = false;



    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
