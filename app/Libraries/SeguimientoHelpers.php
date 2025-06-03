<?php

namespace App\Libraries;

use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use App\Models\CajaVentas\VentasAccesoriosModel;

trait SeguimientoHelpers
{
  protected $ventasModel;
  protected $contratosModel;
  protected $pagosModel;
  protected $id_user;
  protected $hoy;

  public function initSeguimientoHelpers(
    VentasAccesoriosModel $ventasModel,
    ContractModel $contratosModel,
    PagosModel $pagosModel,
    string $id_user,
    string $hoy
  ) {
    $this->ventasModel = $ventasModel;
    $this->contratosModel = $contratosModel;
    $this->pagosModel = $pagosModel;
    $this->id_user = $id_user;
    $this->hoy = $hoy;
  }

  private function obtenerResumenMonetario($sedeId)
  {
    $data = [];

    // Totales para Ventas, Contratos y Pagos
    foreach (['PEN', 'USD'] as $moneda) {
      $key = strtolower($moneda);

      // Ventas
      $data["total_venta_{$key}"] = moneda($this->getMonetarioTotal(
        $this->ventasModel,
        'monto_total',
        $moneda,
        $sedeId
      ));

      // Contratos
      $data["total_contrato_{$key}"] = moneda($this->getMonetarioTotal(
        $this->contratosModel,
        'monto_total',
        $moneda,
        $sedeId
      ));

      // Pagos de Ventas + Contratos
      $data["pagos_total_{$key}"] = moneda($this->getMonetarioTotal(
        $this->pagosModel,
        'monto',
        $moneda,
        $sedeId,
        ['modulo' => ['venta', 'contrato']]
      ));

      // Pagos Citas + Mantenimientos (Faltaba esto)
      $data["pagos_total_citas_managment_{$key}"] = moneda($this->getMonetarioTotal(
        $this->pagosModel,
        'monto',
        $moneda,
        $sedeId,
        ['modulo' => ['cita', 'mantenimiento']]
      ));
    }

    // Conteos (Sección faltante)
    $data += [
      'count_cita_manag' => $this->getCountPagos(['cita', 'mantenimiento'], '', $sedeId),
      'count_cita'       => $this->getCountPagos('cita', 'PEN', $sedeId),
      'count_manag'      => $this->getCountPagos('mantenimiento', 'PEN', $sedeId),
      'count_ventas_soles'    => $this->getCountContractVenta('venta', 'PEN', $sedeId),
      'count_ventas_dolares'  => $this->getCountContractVenta('venta', 'USD', $sedeId),
      'count_contract_soles'   => $this->getCountContractVenta('contrato', 'PEN', $sedeId),
      'count_contract_dolares' => $this->getCountContractVenta('contrato', 'USD', $sedeId),
      'count_pagos_soles'      => $this->getCountPagos(['contrato', 'venta'], 'PEN', $sedeId),
      'count_pagos_dolares'    => $this->getCountPagos(['contrato', 'venta'], 'USD', $sedeId)
    ];

    return $data;
  }

  private function formatearItem(array $item, array $camposExtra = [])
  {
    $formateado = [
      'id'            => $item['id'],
      'paciente'      => mb_strtoupper($item['nombres'] . ' ' . $item['apellidos']),
      'cod_paciente'  => $item['cod_paciente'],
      'monto_format'  => moneda($item['monto'] ?? $item['monto_total']),
      'moneda'        => ($item['moneda'] == 'PEN') ? 'S/.' : '$',
      'sede'          => $item['sede'],
      'fecha'         => fecha_dmy($item['fecha_inicio'] ?? fecha_dmy($item['created_at']))
    ];

    return array_merge($formateado, $camposExtra);
  }

  private function getMonetarioTotal($model, string $campo, string $moneda, $id_sede, array $filtros = [])
  {
    $query = $model
      ->selectSum($campo, 'total')
      ->where('user_id', $this->id_user)
      ->where('moneda', $moneda)
      ->where("DATE({$model->table}.created_at)", $this->hoy);

    if ($id_sede !== 'todas') {
      $query->where('sede_id',  $id_sede);
    }

    foreach ($filtros as $key => $val) {
      is_array($val)
        ? $query->whereIn($key, $val)
        : $query->where($key, $val);
    }

    $result = $query->first();
    return ($result['total'] ?? 0);
  }

  private function getCountPagos($modulo = null, $moneda = null, $id_sede)
  {
    $query = $this->pagosModel
      ->where('user_id', $this->id_user)
      ->where("DATE(pagos.created_at)", $this->hoy);

    if ($id_sede !== 'todas') {
      $query->where('sede_id',  $id_sede);
    }

    if ($modulo) {
      is_array($modulo)
        ? $query->whereIn('modulo', $modulo)
        : $query->where('modulo', $modulo);
    }

    if ($moneda) {
      $query->where('moneda', $moneda);
    }

    return $query->countAllResults();
  }

  private function getCountContractVenta(string $model, $moneda = null, $id_sede)
  {
    $dt = ($model == 'contrato') ? $this->contratosModel : $this->ventasModel;

    $query = $dt
      ->where('user_id', $this->id_user)
      ->where("DATE(created_at) >=", $this->hoy);

    if ($id_sede !== 'todas') {
      $query->where('sede_id',  $id_sede);
    }

    if ($moneda) {
      $query->where('moneda', $moneda);
    }

    return $query->countAllResults();
  }





  private function obtenerResumenMonetarioBeetween($sedeId, string $start, string $end)
  {
    $data = [];

    // Totales para Ventas, Contratos y Pagos
    foreach (['PEN', 'USD'] as $moneda) {
      $key = strtolower($moneda);

      // Ventas
      $data["total_venta_{$key}"] = moneda($this->getMonetarioTotalBeetween(
        $this->ventasModel,
        'monto_total',
        $moneda,
        $sedeId,
        $start,
        $end,
      ));

      // Contratos
      $data["total_contrato_{$key}"] = moneda($this->getMonetarioTotalBeetween(
        $this->contratosModel,
        'monto_total',
        $moneda,
        $sedeId,
        $start,
        $end,
      ));

      // Pagos de Ventas + Contratos
      $data["pagos_total_{$key}"] = moneda($this->getMonetarioTotalBeetween(
        $this->pagosModel,
        'monto',
        $moneda,
        $sedeId,
        $start,
        $end,
        ['modulo' => ['venta', 'contrato']]
      ));

      // Pagos Citas + Mantenimientos (Faltaba esto)
      $data["pagos_total_citas_managment_{$key}"] = moneda($this->getMonetarioTotalBeetween(
        $this->pagosModel,
        'monto',
        $moneda,
        $sedeId,
        $start,
        $end,
        ['modulo' => ['cita', 'mantenimiento']]
      ));
    }

    // Conteos (Sección faltante)
    $data += [
      'count_cita_manag' => $this->getCountPagosBeetween(['cita', 'mantenimiento'], '', $sedeId, $start, $end),
      'count_cita'       => $this->getCountPagosBeetween('cita', 'PEN', $sedeId, $start, $end),
      'count_manag'      => $this->getCountPagosBeetween('mantenimiento', 'PEN', $sedeId, $start, $end),
      'count_pagos_soles'      => $this->getCountPagosBeetween(['contrato', 'venta'], 'PEN', $sedeId, $start, $end),
      'count_pagos_dolares'    => $this->getCountPagosBeetween(['contrato', 'venta'], 'USD', $sedeId, 
      $start, $end),
      
      'count_ventas_soles'    => $this->getCountContractVentaBeetween('venta', 'PEN', $sedeId, $start, $end),
      'count_ventas_dolares'  => $this->getCountContractVentaBeetween('venta', 'USD', $sedeId, $start, $end),
      'count_contract_soles'   => $this->getCountContractVentaBeetween('contrato', 'PEN', $sedeId, $start, $end),
      'count_contract_dolares' => $this->getCountContractVentaBeetween('contrato', 'USD', $sedeId, $start, $end),
    ];

    return $data;
  }

  private function getMonetarioTotalBeetween($model, string $campo, string $moneda, $id_sede, string $start, string $end, array $filtros = [])
  {
    $query = $model
      ->selectSum($campo, 'total')
      ->where('user_id', $this->id_user)
      ->where('moneda', $moneda)
      ->where("DATE({$model->table}.created_at) >=", $start)
      ->where("DATE({$model->table}.created_at) <=", $end);

    if ($id_sede !== 'todas') {
      $query->where('sede_id', $id_sede);
    }

    foreach ($filtros as $key => $val) {
      is_array($val)
        ? $query->whereIn($key, $val)
        : $query->where($key, $val);
    }

    $result = $query->first();
    return ($result['total'] ?? 0);
  }

  private function getCountPagosBeetween($modulo = null, $moneda = null, $id_sede, string $start, string $end)
  {
    $query = $this->pagosModel
      ->where('user_id', $this->id_user)
      ->where("DATE(pagos.created_at) >=", $start)
      ->where("DATE(pagos.created_at) <=", $end);

    if ($id_sede !== 'todas') {
      $query->where('sede_id',  $id_sede);
    }


    if ($modulo) {
      is_array($modulo)
        ? $query->whereIn('modulo', $modulo)
        : $query->where('modulo', $modulo);
    }

    if ($moneda) {
      $query->where('moneda', $moneda);
    }

    return $query->countAllResults();
  }

  private function getCountContractVentaBeetween(string $model, $moneda = null, $id_sede, string $start, string $end)
  {
    $dt = ($model == 'contrato') ? $this->contratosModel : $this->ventasModel;

    $query = $dt
      ->where('user_id', $this->id_user)
      ->where("DATE(created_at) >=", $start)
      ->where("DATE(created_at) <=", $end);

    if ($id_sede !== 'todas') {
      $query->where('sede_id',  $id_sede);
    }

    if ($moneda) {
      $query->where('moneda', $moneda);
    }

    return $query->countAllResults();
  }
}
