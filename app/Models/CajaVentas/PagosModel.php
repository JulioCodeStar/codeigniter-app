<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class PagosModel extends Model
{
    protected $table            = 'pagos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['modulo', 'referencia_id', 'paciente_id', 'tip_pago', 'moneda', 'monto', 'observaciones'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];


    public function getAllPagos(string $modulo) 
    {
      return $this->select([
                'pagos.*',
                'pacientes.nombres',
                'pacientes.apellidos',
                'pacientes.cod_paciente',
                'jobs.descripcion AS trabajo',
            ])
            ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
            // 1) unir con contratos
            ->join('contratos ct','ct.id           = pagos.referencia_id','left')
            // 2) si es necesario, unir cotizaciones (si contratos.cotizacion_id existe)
            ->join('cotizaciones co','co.id        = ct.cotizacion_id',     'left')
            // 3) finalmente unir jobs
            ->join('jobs',         'jobs.id        = co.jobs_id',          'left')
            ->where('pagos.modulo', $modulo)
            ->findAll();  
    }
}
