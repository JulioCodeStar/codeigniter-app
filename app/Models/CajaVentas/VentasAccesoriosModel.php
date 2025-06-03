<?php

namespace App\Models\CajaVentas;

use CodeIgniter\Model;

class VentasAccesoriosModel extends Model
{
  protected $table            = 'ventas_accesorios';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'n_boleta', 'cotizacion_id', 'paciente_id', 'fecha_inicio', 'fecha_garantia', 'monto_total', 'moneda', 'user_id', 'sede_id'];

  protected bool $allowEmptyInserts = false;

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = ['generatedBoleta'];

  protected function generatedBoleta(array $data): array
  {
    $boletaPrefix = 'BOL-';

    $ultimo = $this->like('n_boleta', $boletaPrefix, 'after')->orderBy('n_boleta', 'DESC')->first();

    if ($ultimo) {
      $codigo = is_array($ultimo) ? $ultimo['n_boleta'] : $ultimo->n_boleta;

      $num = (int) preg_replace('/\D/', '', $codigo);
    } else {
      $num = 0;
    }

    ++$num;
    $sufijo = str_pad($num, 6, '0', STR_PAD_LEFT);

    $data['data']['n_boleta'] = $boletaPrefix . $sufijo;

    return $data;
  }

  public function getAllVentasDate(string $fecha, int $id_sede)
  {
    $subquery = $this->db->table('pagos')
      ->select('referencia_id, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at ASC) as pago_nro')
      ->where('modulo', 'venta')
      ->orderBy('created_at', 'ASC')
      ->getCompiledSelect();

    return $this->select('ventas_accesorios.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, p.pago_nro')
      ->join('pacientes', 'pacientes.id = ventas_accesorios.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join("($subquery) as p", 'p.referencia_id = ventas_accesorios.id', 'left')
      ->where('ventas_accesorios.sede_id', $id_sede)
      ->where("DATE(ventas_accesorios.created_at) = '{$fecha}'", null, false)
      ->findAll();
  }

  public function getAllVentas()
  {
    return $this->select('ventas_accesorios.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo')
      ->join('pacientes', 'pacientes.id = ventas_accesorios.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->findAll();
  }

  public function getVentastById(int $id_ventas)
  {
    return $this->select('ventas_accesorios.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, pacientes.dni, pacientes.direccion, pacientes.sede, jobs.descripcion AS trabajo, cotizaciones.peso, cotizaciones.ajustes, servicios.id AS servicios_id')
      ->join('pacientes', 'pacientes.id = ventas_accesorios.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->find($id_ventas);
  }


  public function getAllPagosById(int $id_ventas)
  {
    $subquery = $this->db->table('pagos')
      ->select('id, created_at, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at ASC) as pago_nro')
      ->where('modulo', 'venta')
      ->where('referencia_id', $id_ventas)
      ->orderBy('created_at', 'ASC')
      ->getCompiledSelect();

    return $this->select('pagos.*, ventas_accesorios.fecha_inicio, ventas_accesorios.moneda, ventas_accesorios.monto_total, ventas_accesorios.n_boleta, CONCAT(pacientes.nombres, " ", pacientes.apellidos) AS paciente, pacientes.dni, pacientes.cod_paciente, sedes.sucursal AS sede, jobs.descripcion AS trabajo, p.pago_nro')
      ->join('pagos', 'referencia_id = ventas_accesorios.id', 'left')
      ->join('pacientes', 'ventas_accesorios.paciente_id = pacientes.id', 'left')
      ->join('sedes', 'ventas_accesorios.sede_id = sedes.id', 'left')
      ->join('cotizaciones', 'ventas_accesorios.cotizacion_id = cotizaciones.id', 'left')
      ->join('jobs', 'cotizaciones.jobs_id = jobs.id', 'left')
      ->join("($subquery) as p", 'p.id = pagos.id', 'left')
      ->where('pagos.modulo', 'venta')
      ->where('pagos.referencia_id', $id_ventas)
      ->orderBy('pagos.created_at', 'ASC')
      ->findAll();
  }

  public function getResumenVentas(string $hoy, string $id_user, int $sede_id): array
  {
    return $this
      ->select("
                ventas_accesorios.n_boleta,
                CONCAT(p.nombres, ' ', p.apellidos) AS paciente,
                p.cod_paciente,
                ventas_accesorios.moneda,
                jobs.descripcion AS trabajo,
                ventas_accesorios.monto_total,
                COALESCE(SUM(pagos.monto), 0) AS pagado,
                (ventas_accesorios.monto_total - COALESCE(SUM(pagos.monto), 0)) AS pendiente,
                CASE
                  WHEN (ventas_accesorios.monto_total - COALESCE(SUM(pagos.monto), 0)) = 0 THEN 'Pagado'
                  ELSE 'Deuda'
                END AS estado
            ")
      ->join('pacientes p', 'p.id = ventas_accesorios.paciente_id')
      ->join('cotizaciones ct', 'ct.id = ventas_accesorios.cotizacion_id')
      ->join('jobs', 'jobs.id = ct.jobs_id', 'left')
      ->join(
        'pagos',
        "pagos.modulo = 'venta' AND pagos.referencia_id = ventas_accesorios.id",
        'left'
      )
      ->groupBy('ventas_accesorios.id')
      ->orderBy('ventas_accesorios.created_at', 'DESC')
      ->where("DATE(pagos.created_at) = '{$hoy}'", null, false)
      ->where('ventas_accesorios.user_id', $id_user)
      ->where('ventas_accesorios.sede_id', $sede_id)
      ->findAll(5);
  }

  public function getAllResumenVentas()
  {
    return $this
      ->select("
                ventas_accesorios.id,
                CONCAT(p.nombres, ' ', p.apellidos) AS paciente,
                p.cod_paciente,
                CONCAT(u.nombres, ' ', u.apellidos) AS usuario,
                ventas_accesorios.moneda,
                jobs.descripcion AS trabajo,
                ventas_accesorios.monto_total,
                COALESCE(SUM(pagos.monto), 0) AS pagado,
                (ventas_accesorios.monto_total - COALESCE(SUM(pagos.monto), 0)) AS pendiente,
                CASE
                  WHEN (ventas_accesorios.monto_total - COALESCE(SUM(pagos.monto), 0)) = 0 THEN 'Pagado'
                  ELSE 'Deuda'
                END AS estado
            ")
      ->join('pacientes p', 'p.id = ventas_accesorios.paciente_id')
      ->join('cotizaciones ct', 'ct.id = ventas_accesorios.cotizacion_id')
      ->join('users u', 'u.id = ventas_accesorios.user_id')
      ->join('jobs', 'jobs.id = ct.jobs_id', 'left')
      ->join(
        'pagos',
        "pagos.modulo = 'venta' AND pagos.referencia_id = ventas_accesorios.id",
        'left'
      )
      ->groupBy('ventas_accesorios.id')
      ->orderBy('ventas_accesorios.created_at', 'DESC')
      ->findAll();
  }


  public function getAllVentasByDateAndDate($sede, string $fecha)
  {
    $builder = $this->select('ventas_accesorios.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, sedes.sucursal AS sede')
      ->join('pacientes', 'pacientes.id = ventas_accesorios.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('sedes', 'sedes.id = ventas_accesorios.sede_id', 'left')
      ->where("DATE(ventas_accesorios.created_at) = '{$fecha}'", null, false);

    if ($sede !== 'todas') {
      $builder->where("ventas_accesorios.sede_id", $sede);
    }

    return $builder->findAll();
  }

  public function getAllVentasByDateBeetweenAndDate($sede, string $start, string $end)
  {
    $builder = $this->select('ventas_accesorios.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, sedes.sucursal AS sede')
      ->join('pacientes', 'pacientes.id = ventas_accesorios.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = ventas_accesorios.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('sedes', 'sedes.id = ventas_accesorios.sede_id', 'left')
      ->where("DATE(ventas_accesorios.created_at) >=", $start)
      ->where("DATE(ventas_accesorios.created_at) <=", $end);

    if ($sede !== 'todas') {
      $builder->where("ventas_accesorios.sede_id", $sede);
    }

    return $builder->findAll();
  }
}
