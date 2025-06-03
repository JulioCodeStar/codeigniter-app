<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ActivityModel;
use App\Models\CajaVentas\CajaModel;
use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use App\Models\CajaVentas\ReporteModel;
use App\Models\CajaVentas\VentasAccesoriosModel;
use App\Models\SedeModel;

class SalesController extends BaseController
{
  protected $cajaModel, $actividadModel, $contractModel, $pagosModel, $hoy, $ventasModel, $id_user, $reportesModel, $id_sede, $sedeModel;

  public function __construct()
  {
    $this->cajaModel      = new CajaModel();
    $this->actividadModel = new ActivityModel();
    $this->contractModel  = new ContractModel();
    $this->pagosModel     = new PagosModel();
    $this->ventasModel    = new VentasAccesoriosModel();
    $this->reportesModel  = new ReporteModel();
    $this->sedeModel      = new SedeModel();


    $this->hoy            = date('Y-m-d');
    $this->id_user        = session('caja_user')['id'];
    $this->id_sede        = session('caja_user')['sede_id'];
  }

  public function index()
  {
    $data['apertura']   = $this->getCajaAbierta();

    $data['ventas']     = $this->ventasModel->getResumenVentas($this->hoy, $this->id_user, $this->id_sede);
    $data['contract']   = $this->contractModel->getResumenContract($this->hoy, $this->id_user, $this->id_sede);
    $data['cita']       = $this->pagosModel->getResumenCitasMantenimiento('cita', $this->hoy, $this->id_user, $this->id_sede);
    $data['managment']  = $this->pagosModel->getResumenCitasMantenimiento('mantenimiento', $this->hoy, $this->id_user, $this->id_sede);

    $data['sede']       = $this->sedeModel->select("sucursal")->find($this->id_sede);

    // Resumen Monetarios
    $data['total_venta_soles'] = $this->getMonetarioTotal($this->ventasModel, 'monto_total', 'PEN', $this->id_sede );
    $data['total_contract_soles'] = $this->getMonetarioTotal($this->contractModel, 'monto_total', 'PEN', $this->id_sede );
    $data['pagos_total_soles'] = $this->getMonetarioTotal($this->pagosModel, 'monto', 'PEN', $this->id_sede, ['modulo' => ['venta', 'contrato']]);
    $data['pagos_total_citas_managment_soles'] = $this->getMonetarioTotal($this->pagosModel, 'monto', 'PEN', $this->id_sede, ['modulo' => ['cita', 'mantenimiento']]);

    $data['total_venta_dolares'] = $this->getMonetarioTotal($this->ventasModel, 'monto_total', 'USD', $this->id_sede);
    $data['total_contract_dolares'] = $this->getMonetarioTotal($this->contractModel, 'monto_total', 'USD', $this->id_sede );
    $data['pagos_total_dolares'] = $this->getMonetarioTotal($this->pagosModel, 'monto', 'USD', $this->id_sede, ['modulo' => ['venta', 'contrato']]);
    $data['pagos_total_citas_managment_dolares'] = $this->getMonetarioTotal($this->pagosModel, 'monto', 'USD', $this->id_sede, ['modulo' => ['cita', 'mantenimiento']]);


    // Conteos Soles y Dolares
    $data['count_cita_manag'] = $this->getCountPagos(['cita', 'mantenimiento'], '', $this->id_sede);
    $data['count_cita'] = $this->getCountPagos('cita', 'PEN', $this->id_sede);
    $data['count_manag'] = $this->getCountPagos('mantenimiento', 'PEN', $this->id_sede);
    $data['count_ventas_soles'] = $this->getCountPagos('venta', 'PEN', $this->id_sede);

    $data['count_contract_soles'] = $this->getCountPagos('contrato', 'PEN', $this->id_sede);
    $data['count_pagos_soles'] = $this->getCountPagos(['contrato', 'venta'], 'PEN', $this->id_sede);
  

    $data['count_ventas_dolares'] = $this->getCountPagos('venta', 'USD', $this->id_sede);
    $data['count_contract_dolares'] = $this->getCountPagos('contrato', 'USD', $this->id_sede);
    $data['count_pagos_dolares'] = $this->getCountPagos(['contrato', 'venta'], 'USD', $this->id_sede);

    // Conteos Totales
    $data['count_total_venta'] = $this->getCountPagos('venta', '', $this->id_sede);
    $data['count_contract_total'] = $this->getCountPagos('contrato', '', $this->id_sede);
    $data['count_pagos_total'] = $this->getCountPagos(['contrato', 'venta'], '', $this->id_sede);

    return view('sales/index', $data);
  }

  private function getMonetarioTotal($model, string $campo, string $moneda, int $id_sede, array $filtros = [])
  {
    $query = $model
      ->selectSum($campo, 'total')
      ->where('user_id', $this->id_user)
      ->where('moneda', $moneda)
      ->where('sede_id', $id_sede)  
      ->where("DATE({$model->table}.created_at)", $this->hoy);

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
      ->where('sede_id',  $id_sede)
      ->where("DATE(pagos.created_at)", $this->hoy);


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

  private function getCajaAbierta()
  {
    return $this->cajaModel
      ->where('sede_id', session('caja_user')['sede_id'])
      ->where('user_id', session('caja_user')['id'])
      ->where('estado', 'abierta')
      ->first();
  }

  public function OpenSales()
  {
    $sedeId = session('caja_user')['sede_id'];
    $userId = session('caja_user')['id'];

    if ($this->cajaModel->where('sede_id', $sedeId)->where('user_id', $userId)->where('estado', 'abierta')->first()) {
      return $this->response->setJSON([
        'status' => 'exists',
        'message' => 'Ya hay una caja abierta para esta sede.'
      ]);
    }

    $this->cajaModel->insert([
      'sede_id' => $sedeId,
      'user_id' => $userId,
      'hora_apertura' => date('Y-m-d H:i:s'),
      'estado' => 'abierta'
    ], true);

    $this->actividadModel->insert([
      'movimiento_id' => null, // porque no está ligado a un movimiento
      'accion' => 'crear',
      'descripcion' => 'Apertura de caja para sede ' . $sedeId,
      'user_id' => $userId,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    return $this->response->setJSON([
      'status'    => 'success',
      'redirect'  => base_url('/sales') // o usar '/' si quieres recargar la misma
    ]);
  }

  public function CloseSales()
  {
    $sedeId = session('caja_user')['sede_id'];
    $userId = session('caja_user')['id'];

    $caja = $this->cajaModel
      ->where('sede_id', $sedeId)
      ->where('user_id', $userId)
      ->where('estado', 'abierta')
      ->first();

    if ($caja) {
      $this->cajaModel->update($caja['id'], [
        'estado' => 'cerrada',
        'hora_cierre' => date('Y-m-d H:i:s'),
      ]);

      $this->actividadModel->insert([
        'movimiento_id' => null,
        'accion'        => 'actualizar',
        'descripcion'   => 'Cierre de caja para sede ' . $sedeId,
        'user_id'       => $userId,
        'created_at'    => date('Y-m-d H:i:s'),
      ]);

      $this->reportesModel->insert([
        'caja_id' => $caja['id'],
        'generado_por' => $userId,
        'generado_en' => $sedeId
      ]);

      return $this->response->setJSON([
        'status'    => 'success',
        'redirect'  => base_url('/sales') // o usar '/' si quieres recargar la misma
      ]);
    }
  }
}
