<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class ReporteModel extends Model
{
  protected $table            = 'reportes';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['caja_id', 'generado_por', 'generado_en'];

  protected bool $allowEmptyInserts = false;
}