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
  protected $allowedFields    = ['paciente_id', 'cotizacion_id', 'fecha_inicio', 'fecha_garantia', 'monto_total', 'moneda', 'user_id', 'sede_id'];

  protected bool $allowEmptyInserts = false;


  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getAllContract()
  {
    return $this->select('contratos.*, pacientes.id AS id_paciente, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->findAll();
  }

  public function getAllContractDate(string $fecha, int $sede_id)
  {
    return $this->select('contratos.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, sedes.sucursal')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('sedes', 'sedes.id = contratos.sede_id', 'left')
      ->where("DATE(contratos.created_at) = '{$fecha}'", null, false)
      ->where("contratos.sede_id", $sede_id)
      ->findAll();
  }

  public function getContractById(int $id_contract)
  {
    return $this->select('contratos.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, pacientes.dni, pacientes.direccion, pacientes.sede, pacientes.mayor_edad, pacientes.nombres_apoderado, pacientes.apellidos_apoderado, pacientes.dni_apoderado, pacientes.vinculo_apoderado, pacientes.tip_paciente, pacientes.edad, jobs.descripcion AS trabajo, cotizaciones.weight, cotizaciones.ajustes, servicios.id AS servicios_id')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('servicios', 'servicios.id = cotizaciones.servicios_id', 'left')
      ->find($id_contract);
  }

  public function getAllPagosById(int $id_contract)
  {
    $subquery = $this->db->table('pagos')
      ->select('id, created_at, ROW_NUMBER() OVER (PARTITION BY referencia_id ORDER BY created_at) as pago_nro')
      ->where('modulo', 'contrato')
      ->getCompiledSelect();

    return $this->select('pagos.*, p.pago_nro')
      ->join('pagos', 'referencia_id = contratos.id', 'left')
      ->join("($subquery) as p", 'p.id = pagos.id', 'left')
      ->where('pagos.modulo', 'contrato')
      ->where('pagos.referencia_id', $id_contract)
      ->orderBy('pagos.created_at', 'ASC')
      ->findAll();
  }

  public function getAllManagment()
  {
    return $this->select('contratos.*, pacientes.id AS id_paciente, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->findAll();
  }

  public function getResumenContract(string $hoy, string $id_user, int $id_sede): array
  {
    return $this
      ->select("
                CONCAT(p.nombres, ' ', p.apellidos) AS paciente,
                p.cod_paciente,
                contratos.moneda,
                jobs.descripcion AS trabajo,
                contratos.monto_total,
                COALESCE(SUM(pagos.monto), 0) AS pagado,
                (contratos.monto_total - COALESCE(SUM(pagos.monto), 0)) AS pendiente,
                CASE
                  WHEN (contratos.monto_total - COALESCE(SUM(pagos.monto), 0)) = 0 THEN 'Pagado'
                  ELSE 'Deuda'
                END AS estado
            ")
      ->join('pacientes p', 'p.id = contratos.paciente_id')
      ->join('cotizaciones ct', 'ct.id = contratos.cotizacion_id')
      ->join('jobs', 'jobs.id = ct.jobs_id', 'left')
      ->join(
        'pagos',
        "pagos.modulo = 'contrato' AND pagos.referencia_id = contratos.id",
        'left'
      )
      ->groupBy('contratos.id')
      ->orderBy('contratos.created_at', 'DESC')
      ->where("DATE(pagos.created_at) = '{$hoy}'", null, false)
      ->where('contratos.user_id', $id_user)
      ->where('contratos.sede_id', $id_sede)
      ->findAll(5);
  }

  public function getAllResumenContract()
  {
    return $this
      ->select("
                contratos.id,
                CONCAT(p.nombres, ' ', p.apellidos) AS paciente,
                p.sede,
                p.cod_paciente,
                contratos.moneda,
                jobs.descripcion AS trabajo,
                contratos.monto_total,
                COALESCE(SUM(pagos.monto), 0) AS pagado,
                (contratos.monto_total - COALESCE(SUM(pagos.monto), 0)) AS pendiente,
                CASE
                  WHEN (contratos.monto_total - COALESCE(SUM(pagos.monto), 0)) = 0 THEN 'Pagado'
                  ELSE 'Deuda'
                END AS estado
            ")
      ->join('pacientes p', 'p.id = contratos.paciente_id')
      ->join('cotizaciones ct', 'ct.id = contratos.cotizacion_id')
      ->join('jobs', 'jobs.id = ct.jobs_id', 'left')
      ->join(
        'pagos',
        "pagos.modulo = 'contrato' AND pagos.referencia_id = contratos.id",
        'left'
      )
      ->groupBy('contratos.id')
      ->orderBy('contratos.created_at', 'DESC')
      ->findAll();
  }


  public function getAllContractByDateAndSede($sede, string $fecha)
  {
    $builder = $this->select('contratos.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, sedes.sucursal AS sede')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('sedes', 'sedes.id = contratos.sede_id', 'left')
      ->where("DATE(contratos.created_at) = '{$fecha}'", null, false);

    if ($sede !== 'todas') {
      $builder->where("contratos.sede_id", $sede);
    }

    return $builder->findAll();
  }


  public function getAllContractByDateBeetweenAndSede($sede, string $start, string $end)
  {
    $builder = $this->select('contratos.*, pacientes.nombres, pacientes.apellidos, pacientes.cod_paciente, jobs.descripcion AS trabajo, sedes.sucursal AS sede')
      ->join('pacientes', 'pacientes.id = contratos.paciente_id', 'left')
      ->join('cotizaciones', 'cotizaciones.id = contratos.cotizacion_id', 'left')
      ->join('jobs', 'jobs.id = cotizaciones.jobs_id', 'left')
      ->join('sedes', 'sedes.id = contratos.sede_id', 'left')
      ->where("DATE(contratos.fecha_inicio) >= ", $start)
      ->where("DATE(contratos.fecha_inicio) <= ", $end);

    if ($sede !== 'todas') {
      $builder->where("contratos.sede_id", $sede);
    }

    return $builder->findAll();
  }

  /* REPORTES EN EXCEL */
  public function getReporteContratos(string $start, string $end, $sedeId = null): array
  {
    $builder = $this->db->table('contratos c')
      ->select([
        'c.fecha_inicio   AS fecha',
        'CONCAT(p.nombres, " ", p.apellidos) AS paciente',
        'p.dni',
        'p.vendedor',
        'srv.descripcion  AS servicio',
        'jb.descripcion   AS trabajo',
        'ct.igv_valor     AS igv',
        'ct.monto         AS subtotal',
        'ct.descuento     AS descuento',
        'ct.encargado     AS encargado',
        'c.monto_total    AS total',
        'IF(ct.igv = 1, "con igv", "sin igv") AS observacion',
        'sd.sucursal      AS sede',
        // pago acumulado
        'COALESCE(pg.pagado, 0)              AS pagado',
        '(c.monto_total - COALESCE(pg.pagado, 0)) AS pendiente',
      ])
      ->join('pacientes   p', 'p.id  = c.paciente_id')
      ->join('cotizaciones ct', 'ct.id = c.cotizacion_id')
      ->join('servicios    srv', 'srv.id = ct.servicios_id')
      ->join('jobs        jb',  'jb.id  = ct.jobs_id')
      ->join('sedes       sd',  'sd.id = c.sede_id')
      // sub-query de pagos
      ->join(
        '(SELECT referencia_id, SUM(monto) pagado
              FROM pagos
              WHERE modulo = "contrato"
              GROUP BY referencia_id) pg',
        'pg.referencia_id = c.id',
        'left'
      )
      ->where('c.fecha_inicio >=', $start)
      ->where('c.fecha_inicio <=', $end);

    if ($sedeId !== 'todas') {
      $builder->where('c.sede_id', $sedeId);
    }

    return $builder->orderBy('c.fecha_inicio', 'DESC')->get()->getResultArray();
  }
}
