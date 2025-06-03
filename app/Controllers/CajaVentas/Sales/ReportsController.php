<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Libraries\SeguimientoHelpers;
use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use App\Models\CajaVentas\VentasAccesoriosModel;
use App\Models\SedeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Border, Fill, Alignment, Color};

class ReportsController extends BaseController
{
  use SeguimientoHelpers;
  protected $sedeModel, $accesoriosModel, $contractModel, $pagosModel, $hoy;

  function __construct()
  {
    $this->sedeModel        = new SedeModel();
    $this->accesoriosModel  = new VentasAccesoriosModel();
    $this->contractModel    = new ContractModel();
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
    return view('sales/reports/index', $data);
  }

  public function getDataByDateBeetweenAndSede()
  {
    $sede_id  = $this->request->getPost('sede');
    $start    = $this->request->getPost('fecha_inicio');
    $end      = $this->request->getPost('fecha_fin');

    $response = [
      'start' => fecha_spanish($start),
      'end'   => fecha_spanish($end),
      'table' => $this->fetchResumenTable($sede_id, $start, $end),
      'resumen' => $this->obtenerResumenMonetarioBeetween($sede_id, $start, $end),
    ];

    return $this->response->setJSON($response);
  }

  private function fetchResumenTable($sedeId, string $start, string $end)
  {

    $secciones = [
      'ventas' => [
        'modelo' => $this->accesoriosModel,
        'metodo' => 'getAllVentasByDateBeetweenAndDate',
        'camposExtra' => ['n_boleta' => 'n_boleta', 'trabajo' => 'trabajo']
      ],
      'pagos_ventas' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateBeetweenAndSede',
        'args' => ['venta', $start, $end, $sedeId],
        'camposExtra' => ['n_boleta' => 'n_boleta', 'trabajo' => 'trabajo']
      ],
      'contratos' => [
        'modelo' => $this->contractModel,
        'metodo' => 'getAllContractByDateBeetweenAndSede',
        'camposExtra' => ['trabajo' => 'trabajo']
      ],
      'pagos_contratos' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateBeetweenAndSede',
        'args' => ['contrato', $start, $end, $sedeId],
        'camposExtra' => ['trabajo' => 'trabajo']
      ],
      'citas' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateBeetweenAndSede',
        'args' => ['cita', $start, $end, $sedeId],
        'camposExtra' => ['descripcion' => 'observaciones']
      ],
      'mantenimiento' => [
        'modelo' => $this->pagosModel,
        'metodo' => 'getAllPagosByDateBeetweenAndSede',
        'args' => ['mantenimiento', $start, $end, $sedeId],
        'camposExtra' => ['trabajo' => 'trabajo', 'descripcion' => 'observaciones']
      ]
    ];

    $tabla = [];
    foreach ($secciones as $key => $config) {
      $datos = call_user_func_array(
        [$config['modelo'], $config['metodo']],
        $config['args'] ?? [$sedeId, $start, $end]
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

  public function generateReport()
  {    
    $plantillaPath = base_url('assets/xlsx/plantilla-reporte.xlsx');
    $spreadsheet = IOFactory::load($plantillaPath);

    $filaInicial = 5;

    $sheet = $spreadsheet->getActiveSheet();

    
  }

}
