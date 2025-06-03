<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Libraries\SeguimientoHelpers;
use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use App\Models\CajaVentas\VentasAccesoriosModel;
use App\Models\SedeModel;
use CodeIgniter\API\ResponseTrait;

class SeguimientoController extends BaseController
{

  use ResponseTrait;
  use SeguimientoHelpers;
  protected $sedeModel, $hoy, $accesoriosModel, $contratosModel, $pagosModel;

  function __construct()
  {
    $this->sedeModel        = new SedeModel();
    $this->accesoriosModel  = new VentasAccesoriosModel();
    $this->contratosModel   = new ContractModel();
    $this->pagosModel       = new PagosModel();

    $this->hoy              = date('Y-m-d');

    $this->initSeguimientoHelpers(
      new VentasAccesoriosModel(),
      new ContractModel(),
      new PagosModel(),
      session('caja_user')['id'], // O tu método para obtener el ID de usuario
      date('Y-m-d')
    );
  }

  public function index()
  {
    $data['sede'] = $this->sedeModel->findAll();
    return view('sales/seguimiento/index', $data);
  }

  public function getDataByDateAndSede()
  {
    $sede_id  = $this->request->getPost('sede');
    $fecha    = $this->hoy;

    $response = [
      'table'   => $this->fetchResumenTable($sede_id, $fecha),
      'resumen' => $this->obtenerResumenMonetario($sede_id),
    ];

    return $this->response->setJSON($response);
  }

  private function fetchResumenTable($sedeId, string $fecha)
  {

    $secciones = [
      'ventas' => [
        'modelo' => $this->accesoriosModel,
        'metodo' => 'getAllVentasByDateAndDate',
        'camposExtra' => ['n_boleta' => 'n_boleta', 'trabajo' => 'trabajo']
      ],
      'pagos_ventas' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateAndSede',
        'args' => ['venta', $fecha, $sedeId],
        'camposExtra' => ['n_boleta' => 'n_boleta', 'trabajo' => 'trabajo']
      ],
      'contratos' => [
        'modelo' => $this->contratosModel,
        'metodo' => 'getAllContractByDateAndSede',
        'camposExtra' => ['trabajo' => 'trabajo']
      ],
      'pagos_contratos' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateAndSede',
        'args' => ['contrato', $fecha, $sedeId],
        'camposExtra' => ['trabajo' => 'trabajo']
      ],
      'citas' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateAndSede',
        'args' => ['cita', $fecha, $sedeId],
        'camposExtra' => ['descripcion' => 'observaciones']
      ],
      'mantenimiento' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateAndSede',
        'args' => ['mantenimiento', $fecha, $sedeId],
        'camposExtra' => ['trabajo' => 'trabajo', 'descripcion' => 'observaciones']
      ]
    ];

    $tabla = [];
    foreach ($secciones as $key => $config) {
      $datos = call_user_func_array(
        [$config['modelo'], $config['metodo']],
        $config['args'] ?? [$sedeId, $fecha]
      );

      $tabla[$key] = array_map(function ($item) use ($config) {
        $extra = [];
        foreach ($config['camposExtra'] as $dest => $src) {
          $extra[$dest] = $item[$src] ?? null;
        }
        return $this->formatearItem($item, $extra);
      }, $datos);
    }

    return $tabla;
  }
}
