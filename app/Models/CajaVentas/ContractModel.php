<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class ContractModel extends Model
{
    protected $table            = 'contratos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['paciente_id', 'cotizacion_id', 'fecha_inicio', 'fecha_garantia', 'monto_total', 'moneda', 'estado_garantia'];

    protected bool $allowEmptyInserts = false;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getAllContract() 
    {
      return $this->select('contratos.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo')
              ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
              ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
              ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
              ->findAll(); 
    }

}
