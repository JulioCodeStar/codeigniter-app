<?php

use App\Models\CajaVentas\CajaModel;

if (!function_exists('apertura')) {
  /**
   * Indica si la Caja esta Apertura o no iniciada
   * @return string
   */
  function apertura()
  {

    $session = session();

    if (!$session->has('caja_user')) {
      return null;
    }

    $sedeId = $session->get('caja_user')['sede_id'];
    $userId = $session->get('caja_user')['id'];

    $cajaModel = new CajaModel();
    $caja = $cajaModel
        ->where('sede_id', $sedeId)
        ->where('user_id', $userId)
        ->where('estado', 'abierta')
        ->first();

    return $caja ? 1 : 0;
  }
}
