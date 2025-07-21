<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
  protected $table            = 'cotizaciones';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $protectFields    = true;
  protected $allowedFields    = [
    'id',
    'cod_cotizacion',
    'paciente_id',
    'encargado',
    'servicios_id',
    'jobs_id',
    'weight',
    'moneda',
    'monto',
    'aplica_descuento',
    'descuento',
    'igv',
    'igv_valor',
    'garantia',
    'monto_final',
    'ajustes',
    'diagnostico',
    'fecha_now',
    'fecha_exp',
    'aprobacion'
  ];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = ['generateCod'];

  protected function generateCod(array $data)
  {
    $prefix = 'COT-';

    // Buscar la última secuencia del día
    $lastCode = $this->where('cod_cotizacion LIKE', $prefix . '%')
      ->orderBy('id', 'DESC')
      ->first();

    if ($lastCode) {
      // Extraer el número secuencial
      $lastNumber = (int) substr($lastCode['cod_cotizacion'], -7);
      $sequence = str_pad($lastNumber + 1, 7, '0', STR_PAD_LEFT);
    } else {
      // Primera cotización del día
      $sequence = '0000001';
    }

    $codigo = $prefix . $sequence;

    if (!isset($data['data']['cod_cotizacion'])) {
      $data['data']['cod_cotizacion'] = $codigo;
    }

    return $data;
  }

  public function getInvoiceAll()
  {
    return $this->select('cotizaciones.*, pacientes.id AS paciente_id, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, servicios.descripcion AS servicio, jobs.descripcion AS trabajo')
      ->join('pacientes', 'pacientes.id = cotizaciones.paciente_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->findAll();
  }

  public function getInvoiceById(int $id)
  {
    return $this->select('cotizaciones.*, pacientes.id AS id_paciente, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, pacientes.direccion, pacientes.contacto, servicios.descripcion AS servicio, servicios.id AS id_servicio, jobs.descripcion AS trabajo, jobs.id AS id_trabajo')
      ->join('pacientes', 'pacientes.id = cotizaciones.paciente_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->find($id);
  }

  public function getInvoiceByPatient(string $id)
  {
    return $this->select('cotizaciones.*, pacientes.id AS id_paciente, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, pacientes.direccion, pacientes.contacto, servicios.descripcion AS servicio, servicios.id AS id_servicio, jobs.descripcion AS trabajo, jobs.id AS id_trabajo')
      ->join('pacientes', 'pacientes.id = cotizaciones.paciente_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->where('pacientes.id', $id)
      ->findAll();
  }

  public function getInvoiceGroupAll(): array
  {
    // Sub-query que devuelve sólo el ID de la última cotización de cada paciente
    $subquery = $this->db
      ->table('cotizaciones')
      ->select('MAX(id) AS id', false)
      ->where('servicios_id !=', 4)
      ->groupBy('paciente_id')
      ->getCompiledSelect();

    // Query principal: filtramos cotizaciones cuyo ID esté en ese subquery
    return $this
      ->select("
            cotizaciones.id,
            cotizaciones.paciente_id,
            pacientes.id          AS id_paciente,
            pacientes.nombres,
            pacientes.apellidos,
            pacientes.cod_paciente,
            servicios.descripcion AS servicio,
            jobs.descripcion      AS trabajo,
            cotizaciones.created_at
        ")
      ->join('pacientes', 'pacientes.id = cotizaciones.paciente_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->join('jobs',      'jobs.id = cotizaciones.jobs_id',      'left')
      ->where('cotizaciones.servicios_id !=', 4)
      // raw WHERE IN con el subquery de IDs
      ->where("cotizaciones.id IN ({$subquery})", null, false)
      ->orderBy('cotizaciones.created_at', 'DESC')
      ->findAll();
  }


  public function getInvoiceGroupAllVentas()
  {
    $subquery = $this->db->table('cotizaciones')
      ->select('MAX(id) AS id')
      ->groupBy('paciente_id');

    return $this->select('cotizaciones.*, pacientes.id AS id_paciente, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, servicios.descripcion AS servicio, jobs.descripcion AS trabajo')
      ->join('pacientes', 'pacientes.id = cotizaciones.paciente_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->where('cotizaciones.servicios_id =', 4)
      ->whereIn('cotizaciones.id', $subquery)
      ->findAll();
  }
}
