<?php

namespace App\Models\Patient;

use CodeIgniter\Model;

class ConsentimientoModel extends Model
{
    protected $table            = 'consentimiento';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['contrato_id', 'fecha_entrega', 'items', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getConsentimientoById(int $id)
    {
      $query = $this->select('consentimiento.*, pacientes.nombres, pacientes.apellidos, pacientes.sede, pacientes.dni, pacientes.cod_paciente, pacientes.direccion, jobs.descripcion as trabajo')
        ->join('contratos', 'contratos.id = consentimiento.contrato_id', 'left')
        ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
        ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
        ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
        ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
        ->where('contratos.id', $id)
        ->first();

      return $query;
    }

}
