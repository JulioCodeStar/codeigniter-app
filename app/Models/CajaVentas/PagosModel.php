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
  protected $allowedFields    = ['modulo', 'referencia_id', 'paciente_id', 'tip_pago', 'moneda', 'monto', 'observaciones', 'user_id', 'sede_id'];

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


  public function getAllPagos(string $modulo, string $user_id, string $fecha, int $id_sede)
  {
    $subquery = $this->db->table('pagos')
      ->select('id, created_at, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at) as pago_nro')
      ->where('modulo', $modulo)
      ->getCompiledSelect();

    return $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.cod_paciente',
      'jobs.descripcion AS trabajo',
      'p.pago_nro'
    ])
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      // 1) unir con contratos
      ->join('contratos ct', 'ct.id           = pagos.referencia_id', 'left')
      // 2) si es necesario, unir cotizaciones (si contratos.cotizacion_id existe)
      ->join('cotizaciones co', 'co.id        = ct.cotizacion_id',     'left')
      // 3) finalmente unir jobs
      ->join('jobs',         'jobs.id        = co.jobs_id',          'left')
      ->join("($subquery) as p", 'p.id = pagos.id', 'left')
      ->where('pagos.modulo', $modulo)
      ->where('pagos.user_id', $user_id)
      ->where('pagos.sede_id', $id_sede)
      ->where("DATE(pagos.created_at) = '{$fecha}'", null, false)
      ->orderBy('pagos.created_at', 'ASC')
      ->findAll();
  }

  public function getAllPagosByDate(string $modulo, string $fecha, string $user_id, int $sede_id)
  {
    $subquery = $this->db->table('pagos')
      ->select('id, created_at, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at ASC) as pago_nro')
      ->where('modulo', $modulo)
      ->orderBy('created_at', 'ASC')
      ->getCompiledSelect();

    $builder = $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.cod_paciente',
      'jobs.descripcion AS trabajo',
      'p.pago_nro'
    ])
      ->join('pacientes', 'pacientes.id = pagos.paciente_id', 'left')
      ->join("($subquery) as p", 'p.id = pagos.id', 'left');

    if ($modulo === 'contrato') {
      $builder->join('contratos', 'contratos.id = pagos.referencia_id', 'left')
        ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left');
    } else if ($modulo === 'venta') {
      $builder->join('ventas_accesorios', 'ventas_accesorios.id = pagos.referencia_id', 'left')
        ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left');
    }

    $builder->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->where('pagos.modulo', $modulo)
      ->where('pagos.user_id', $user_id)
      ->where('pagos.sede_id', $sede_id)
      ->where("DATE(pagos.created_at) = '{$fecha}'", null, false)
      ->orderBy('pagos.created_at', 'ASC');

    return $builder->findAll();
  }

  public function getAllPagosCitas(string $modulo, string $fecha, string $user_id, int $sede_id)
  {
    return $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.cod_paciente',
    ])
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      ->where('pagos.modulo', $modulo)
      ->where('pagos.user_id', $user_id)
      ->where('pagos.sede_id', $sede_id)
      ->where("DATE(pagos.created_at) = '{$fecha}'", null, false)
      ->findAll();
  }

  public function getResumenCitasMantenimiento(string $modulo, string $fecha, string $user_id, int $id_sede)
  {
    return $this->select("
      pagos.*,
      CONCAT(pacientes.nombres, ' ', pacientes.apellidos) AS paciente,
      pacientes.cod_paciente,
    ")
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      ->where('pagos.modulo', $modulo)
      ->where('pagos.user_id', $user_id)
      ->where('pagos.sede_id', $id_sede)
      ->where("DATE(pagos.created_at) = '{$fecha}'", null, false)
      ->findAll(5);
  }

  public function getAllCitas()
  {
    return $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.cod_paciente',
    ])
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      ->where('pagos.modulo', 'cita')
      ->findAll();
  }

  public function getAllManagment()
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
      ->join('contratos ct', 'ct.id           = pagos.referencia_id', 'left')
      // 2) si es necesario, unir cotizaciones (si contratos.cotizacion_id existe)
      ->join('cotizaciones co', 'co.id        = ct.cotizacion_id',     'left')
      // 3) finalmente unir jobs
      ->join('jobs',         'jobs.id        = co.jobs_id',          'left')
      ->where('pagos.modulo', 'mantenimiento')
      ->findAll();
  }

  public function getAllPagosByDateAndSede($modulo, $fecha, $sede_id)
  {
    // Determina el alias para la referencia (venta o contrato)
    $alias = ($modulo === 'venta') ? 'va' : 'ct';

    $builder = $this
      ->select([
        'pagos.*',
        'DATE(pagos.created_at) as fecha_inicio',
        'pacientes.nombres',
        'pacientes.apellidos',
        'pacientes.cod_paciente',
        'jobs.descripcion AS trabajo',
        'sedes.sucursal AS sede',
        ($modulo === 'venta' ? 'va.n_boleta' : '')
      ])
      ->join('pacientes', 'pacientes.id = pagos.paciente_id', 'left');

    if ($modulo === 'venta') {
      $builder->join("ventas_accesorios {$alias}", "{$alias}.id = pagos.referencia_id", 'left');
    } else {
      $builder->join("contratos {$alias}", "{$alias}.id = pagos.referencia_id", 'left');
    }

    // JOIN a cotizaciones — este alias debe existir en la tabla referenciada
    $builder->join('cotizaciones co', "co.id = {$alias}.cotizacion_id", 'left')
      // Ajuste aquí: usar job_id en lugar de jobs_id
      ->join('jobs', 'jobs.id = co.jobs_id', 'left')
      ->join('sedes', 'sedes.id = pagos.sede_id', 'left')
      ->where('pagos.modulo',  $modulo)
      ->where("DATE(pagos.created_at) = '{$fecha}'", null, false);

    if ($sede_id !== 'todas') {
      $builder->where('pagos.sede_id', $sede_id);
    }

    return $builder->findAll();
  }

  public function getAllPagosByDateBeetweenAndSede($modulo, $start, $end, $sede_id)
  {
    // Determina el alias para la referencia (venta o contrato)
    $alias = ($modulo === 'venta') ? 'va' : 'ct';

    $builder = $this
      ->select([
        'pagos.*',
        'DATE(pagos.created_at) as fecha_inicio',
        'pacientes.nombres',
        'pacientes.apellidos',
        'pacientes.cod_paciente',
        'jobs.descripcion AS trabajo',
        'sedes.sucursal AS sede',
        ($modulo === 'venta' ? 'va.n_boleta' : '')
      ])
      ->join('pacientes', 'pacientes.id = pagos.paciente_id', 'left');

    if ($modulo === 'venta') {
      $builder->join("ventas_accesorios {$alias}", "{$alias}.id = pagos.referencia_id", 'left');
    } else {
      $builder->join("contratos {$alias}", "{$alias}.id = pagos.referencia_id", 'left');
    }

    // JOIN a cotizaciones — este alias debe existir en la tabla referenciada
    $builder->join('cotizaciones co', "co.id = {$alias}.cotizacion_id", 'left')
      // Ajuste aquí: usar job_id en lugar de jobs_id
      ->join('jobs', 'jobs.id = co.jobs_id', 'left')
      ->join('sedes', 'sedes.id = pagos.sede_id', 'left')
      ->where('pagos.modulo',  $modulo)
      ->where("DATE(pagos.created_at) >= ", $start)
      ->where("DATE(pagos.created_at) <= ", $end);

    if ($sede_id !== 'todas') {
      $builder->where("pagos.sede_id", $sede_id);
    }

    return $builder->findAll();
  }

  public function getPagosById(int $id_contract, string $modulo, int $index)
  {
    $subquery = $this->db->table('pagos')
      ->select('id, created_at, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at ASC) as pago_nro')
      ->where('modulo', $modulo)
      ->where('referencia_id', $id_contract)
      ->orderBy('created_at', 'ASC')
      ->getCompiledSelect();

    $builder = $this->select('pagos.*, p.pago_nro')
      ->join("($subquery) as p", 'p.id = pagos.id', 'left');

    if ($modulo === 'contrato') {
      $builder->select('contratos.fecha_inicio, contratos.moneda, contratos.monto_total, CONCAT(pacientes.nombres, " ", pacientes.apellidos) AS paciente, pacientes.dni, pacientes.cod_paciente, sedes.sucursal AS sede, jobs.descripcion AS trabajo')
        ->join('contratos', 'pagos.referencia_id = contratos.id', 'left')
        ->join('pacientes', 'contratos.paciente_id = pacientes.id', 'left')
        ->join('sedes', 'contratos.sede_id = sedes.id', 'left')
        ->join('cotizaciones', 'contratos.cotizacion_id = cotizaciones.id', 'left')
        ->join('jobs', 'cotizaciones.jobs_id = jobs.id', 'left');
    } else if ($modulo === 'venta') {
      $builder->select('ventas_accesorios.fecha_inicio, ventas_accesorios.moneda, ventas_accesorios.monto_total, ventas_accesorios.n_boleta, CONCAT(pacientes.nombres, " ", pacientes.apellidos) AS paciente, pacientes.dni, pacientes.cod_paciente, sedes.sucursal AS sede, jobs.descripcion AS trabajo')
        ->join('ventas_accesorios', 'pagos.referencia_id = ventas_accesorios.id', 'left')
        ->join('pacientes', 'ventas_accesorios.paciente_id = pacientes.id', 'left')
        ->join('sedes', 'ventas_accesorios.sede_id = sedes.id', 'left')
        ->join('cotizaciones', 'ventas_accesorios.cotizacion_id = cotizaciones.id', 'left')
        ->join('jobs', 'cotizaciones.jobs_id = jobs.id', 'left');
    }

    return $builder->where('pagos.modulo', $modulo)
      ->where('pagos.referencia_id', $id_contract)
      ->orderBy('pagos.created_at', 'ASC')
      ->findAll();
  }

  public function getCitaById(int $id)
  {
    return $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.dni',
      'pacientes.cod_paciente',
    ])
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      ->where('pagos.modulo', 'cita')
      ->where('pagos.id', $id)
      ->findAll();
  }

  public function getManagmentById(int $id)
  {
    return $this->select([
      'pagos.*',
      'pacientes.nombres',
      'pacientes.apellidos',
      'pacientes.dni',
      'pacientes.cod_paciente',
    ])
      ->join('pacientes',   'pacientes.id   = pagos.paciente_id',    'left')
      ->where('pagos.modulo', 'mantenimiento')
      ->where('pagos.id', $id)
      ->findAll();
  }
}
