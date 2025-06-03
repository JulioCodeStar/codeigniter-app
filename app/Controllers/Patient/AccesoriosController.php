<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\CajaVentas\VentasAccesoriosModel;
use CodeIgniter\API\ResponseTrait;

class AccesoriosController extends BaseController
{
  use ResponseTrait;
  protected $ventasModal;

  function __construct()
  {
    $this->ventasModal = new VentasAccesoriosModel();
  }

  public function index()
  {
    $data['ventas'] = $this->ventasModal->getAllResumenVentas();
    return view('patients/accesorios/index', $data);
  }

  public function pagos(int $id)
  {
    $response = $this->ventasModal->getVentastById($id);

    // Normalizar a array de contratos
    $isSingle = false;
    if ($response && ! isset($response[0])) {
      $response = [$response];
      $isSingle = true;
    }

    foreach ($response as &$venta) {
      // 1) Traer todos los pagos
      $pagos = $this->ventasModal->getAllPagosById($venta['id']);

      // 1.1) Formatear created_at de cada pago
      foreach ($pagos as &$pago) {
        if (isset($pago['created_at'])) {
          $pago['created_at'] = fecha_dmy($pago['created_at']);
        }
      }
      $venta['pagos'] = $pagos;

      // 2) Sumar los montos de los pagos
      $totalPagos = array_sum(array_column($pagos, 'monto'));

      // 3) Calcular la deuda
      $montoFinal = $venta['monto_total'] ?? 0;
      $saldo = $montoFinal - $totalPagos;
      if ($saldo <= 0) {
        $venta['deuda'] = 'pagado';
      } else {
        $venta['deuda'] = number_format($saldo, 2, '.', '');
      }

      // 4) Formatear fecha_inicio
      $venta['fecha_inicio'] = fecha_dmy($venta['fecha_inicio']);

      // 5) Evaluar garantía
      $hoy = date('Y-m-d');
      if ($venta['fecha_garantia'] < $hoy) {
        $venta['garantia'] = 'caducado';
      } else {
        $venta['garantia'] = 'activa';
      }
    }

    $data['get'] = $isSingle ? $response[0] : $response;

    return view('patients/accesorios/pagos', $data);
  }
}
