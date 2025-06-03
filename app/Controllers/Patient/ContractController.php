<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ContractModel;
use CodeIgniter\API\ResponseTrait;

class ContractController extends BaseController
{
  use ResponseTrait;
  protected $contractModel;
  function __construct()
  {
    $this->contractModel = new ContractModel();
  }

  public function index()
  {
    $data['contract'] = $this->contractModel->getAllResumenContract();
    return view('patients/contract/index', $data);
  }

  /* View: Pagos */
  public function pagos(int $id)
  {
    $response = $this->contractModel->getContractById($id);

    // Normalizar a array de contratos
    $isSingle = false;
    if ($response && ! isset($response[0])) {
      $response = [$response];
      $isSingle = true;
    }

    foreach ($response as &$contract) {
      // 1) Traer todos los pagos
      $pagos = $this->contractModel->getAllPagosById($contract['id']);

      // 1.1) Formatear created_at de cada pago
      foreach ($pagos as &$pago) {
        if (isset($pago['created_at'])) {
          $pago['created_at'] = fecha_dmy($pago['created_at']);
        }
      }
      $contract['pagos'] = $pagos;

      // 2) Sumar los montos de los pagos
      $totalPagos = array_sum(array_column($pagos, 'monto'));

      // 3) Calcular la deuda
      $montoFinal = $contract['monto_total'] ?? 0;
      $saldo = $montoFinal - $totalPagos;
      if ($saldo <= 0) {
        $contract['deuda'] = 'pagado';
      } else {
        $contract['deuda'] = number_format($saldo, 2, '.', '');
      }

      // 4) Formatear fecha_inicio
      $contract['fecha_inicio'] = fecha_dmy($contract['fecha_inicio']);

      // 5) Evaluar garantía
      $hoy = date('Y-m-d');
      if ($contract['fecha_garantia'] < $hoy) {
        $contract['garantia'] = 'caducado';
      } else {
        $contract['garantia'] = 'activa';
      }
    }

    $data['get'] = $isSingle ? $response[0] : $response;
    return view('patients/contract/pagos', $data);
  }
}
