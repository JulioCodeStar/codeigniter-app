<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ActivityModel;
use App\Models\CajaVentas\CajaModel;

class SalesController extends BaseController
{
  public function index()
  {
    $cajaModel          = new CajaModel();
    $data['apertura']   = $cajaModel
      ->where('sede_id', session('caja_user')['sede_id'])
      ->where('user_id', session('caja_user')['id'])
      ->where('estado', 'abierta')
      ->first();

    return view('sales/index', $data);
  }

  public function OpenSales()
  {
    $sedeId = session('caja_user')['sede_id'];
    $userId = session('caja_user')['id'];

    $cajaModel = new CajaModel();
    $actividadModel = new ActivityModel();

    if ($cajaModel->where('sede_id', $sedeId)->where('user_id', $userId)->where('estado', 'abierta')->first()) {
      return $this->response->setJSON([
        'status' => 'exists',
        'message' => 'Ya hay una caja abierta para esta sede.'
      ]);
    }

    $cajaModel->insert([
      'sede_id' => $sedeId,
      'user_id' => $userId,
      'hora_apertura' => date('Y-m-d H:i:s'),
      'estado' => 'abierta'
    ]);

    $actividadModel->insert([
      'movimiento_id' => null, // porque no está ligado a un movimiento
      'accion' => 'crear',
      'descripcion' => 'Apertura de caja para sede ' . $sedeId,
      'user_id' => $userId,
      'created_at' => date('Y-m-d H:i:s')
    ]);

    return $this->response->setJSON([
      'status' => 'success',
      'redirect' => base_url('/sales') // o usar '/' si quieres recargar la misma
    ]);
  }
}
