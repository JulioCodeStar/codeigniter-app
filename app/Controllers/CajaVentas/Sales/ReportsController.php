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
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

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
      $this->hoy,
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
    /* ---------- 1. Cargar plantilla ---------- */
    $plantilla = FCPATH . 'assets/xlsx/plantilla-reporte.xlsx';
    $spreadsheet = IOFactory::load($plantilla);

    /* ---------- 2. Parámetros de filtro ---------- */
    $sedeId = $this->request->getPost('sede');
    $start  = $this->request->getPost('fecha_inicio');
    $end    = $this->request->getPost('fecha_fin');

    /* ---------- 3. Preparar datos ---------- */
    $contratos      = $this->contractModel->getReporteContratos($start, $end, $sedeId);
    $ventas         = $this->accesoriosModel->getReporteVentasAccesorios($start, $end, $sedeId);
    $pagosContratos = $this->pagosModel->getPagosReporte($start, $end, 'contrato', $sedeId);
    $pagosVentas    = $this->pagosModel->getPagosReporte($start, $end, 'venta', $sedeId);
    $citas          = $this->pagosModel->getCitasManagmentReporte($start, $end, 'cita', $sedeId);
    $mantenimientos = $this->pagosModel->getCitasManagmentReporte($start, $end, 'mantenimiento', $sedeId);

    /* ---------- 4. Rellenar HOJA 1 (contratos) ---------- */
    $hojaContratos = $spreadsheet->getSheetByName('Contratos') ?? $spreadsheet->getSheet(0);
    $this->fillContractsSheet($hojaContratos, $contratos, 5);   // fila 5 = maestra

    /* ---------- 5. Rellenar HOJA 2 (ventas accesorios) --- */
    $hojaVentas = $spreadsheet->getSheetByName('Ventas Accesorios') ?? $spreadsheet->getSheet(1);
    $this->fillSalesSheet($hojaVentas, $ventas, 5);             // fila 5 = maestra

    /* ---------- 6. Rellenar HOJA 3 (pagos contratos) --- */
    $hojaPagosContratos = $spreadsheet->getSheetByName('Pagos Contratos') ?? $spreadsheet->getSheet(2);
    $this->fillPaymentsSheet($hojaPagosContratos, $pagosContratos, 5);   // fila 5 = maestra

    /* ---------- 7. Rellenar HOJA 4 (pagos ventas) --- */
    $hojaPagosVentas = $spreadsheet->getSheetByName('Pagos Ventas') ?? $spreadsheet->getSheet(3);
    $this->fillPaymentsSheet($hojaPagosVentas, $pagosVentas, 5);   // fila 5 = maestra

    /* ---------- 8. Rellenar HOJA 5 (citas) --- */
    $hojaCitas = $spreadsheet->getSheetByName('Citas') ?? $spreadsheet->getSheet(4);
    $this->fillCitasMantenimientoSheet($hojaCitas, $citas, 5);   // fila 5 = maestra

    /* ---------- 9. Rellenar HOJA 6 (mantenimientos) --- */
    $hojaMantenimientos = $spreadsheet->getSheetByName('Mantenimiento') ?? $spreadsheet->getSheet(5);
    $this->fillCitasMantenimientoSheet($hojaMantenimientos, $mantenimientos, 5);   // fila 5 = maestra

    /* ---------- 10. Descargar ---------- */
    $fileName = 'reporte_' . date('Ymd_His') . '.xlsx';
    $writer   = new Xlsx($spreadsheet);

    ob_start();
    $writer->save('php://output');
    $excel = ob_get_clean();

    return $this->response
      ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
      ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
      ->setBody($excel);
  }

  /* ==========================================================
     *  Contratos
     * ======================================================== */
  private function fillContractsSheet(
    \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
    array $rows,
    int $firstRow = 5
  ): void {
    $current = $firstRow;

    foreach ($rows as $idx => $r) {
      if ($idx > 0) {                                   // clonar estilos
        $sheet->insertNewRowBefore($current, 1);
        $sheet->duplicateStyle(
          $sheet->getStyle('A' . ($current - 1) . ':O' . ($current - 1)),
          'A' . $current . ':O' . $current
        );
      }

      $fecha = new \DateTime($r['fecha']);        // Suponiendo 'fecha' viene tipo Y-m-d H:i:s
      $meses = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
      ];
      $sheet->setCellValue("A{$current}", $idx + 1);
      $sheet->setCellValue("B{$current}", $fecha->format('d/m/Y'));
      $sheet->setCellValue("C{$current}", mb_strtoupper($meses[$fecha->format('m')]));   // Mes en español
      $sheet->setCellValue("D{$current}", $fecha->format('Y'));

      $sheet->setCellValue("E{$current}", mb_strtoupper($r['paciente']));
      $sheet->setCellValue("F{$current}", $r['dni']);
      $sheet->setCellValue("G{$current}", mb_strtoupper($r['servicio']));
      $sheet->setCellValue("H{$current}", mb_strtoupper($r['trabajo']));
      $sheet->setCellValue("I{$current}", 1);

      // 4.2) Valores monetarios
      $sheet->setCellValue("J{$current}", $r['igv']);
      $sheet->setCellValue("K{$current}", $r['subtotal']);
      $sheet->setCellValue("L{$current}", $r['descuento']);
      $sheet->setCellValue("M{$current}", $r['total']);
      $sheet->setCellValue("N{$current}", $r['pagado']);
      $sheet->setCellValue("O{$current}", $r['pendiente']);

      $sheet->setCellValue("P{$current}", mb_strtoupper($r['vendedor']));
      $sheet->setCellValue("Q{$current}", mb_strtoupper($r['encargado']));

      // 4.3) Datos finales
      $sheet->setCellValue("R{$current}", mb_strtoupper($r['sede']));
      $sheet->setCellValue("S{$current}", mb_strtoupper($r['observacion']));     // “con igv” / “sin igv”

      $current++;
    }

    $this->formatMoneyColumns($sheet, ['H', 'I', 'J', 'K', 'L', 'M'], $firstRow, $current - 1);
  }

  /* ==========================================================
   *  Ventas accesorios
   * ======================================================== */
  private function fillSalesSheet(
    \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
    array $rows,
    int $firstRow = 5
  ): void {
    $current = $firstRow;

    foreach ($rows as $idx => $r) {
      if ($idx > 0) {
        $sheet->insertNewRowBefore($current, 1);
        $sheet->duplicateStyle(
          $sheet->getStyle('A' . ($current - 1) . ':G' . ($current - 1)),
          'A' . $current . ':G' . $current
        );
      }

      $fecha = new \DateTime($r['fecha']);        // Suponiendo 'fecha' viene tipo Y-m-d H:i:s
      $meses = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
      ];
      $sheet->setCellValue("A{$current}", $idx + 1);
      $sheet->setCellValue("B{$current}", $fecha->format('d/m/Y'));
      $sheet->setCellValue("C{$current}", mb_strtoupper($meses[$fecha->format('m')]));   // Mes en español
      $sheet->setCellValue("D{$current}", $fecha->format('Y'));

      $sheet->setCellValue("E{$current}", mb_strtoupper($r['paciente']));
      $sheet->setCellValue("F{$current}", $r['dni']);
      $sheet->setCellValue("G{$current}", mb_strtoupper($r['trabajo']));
      $sheet->setCellValue("H{$current}", mb_strtoupper($r['items']));
      $sheet->setCellValue("I{$current}", 1);

      // 4.2) Valores monetarios
      $sheet->setCellValue("J{$current}", $r['igv']);
      $sheet->setCellValue("K{$current}", $r['subtotal']);
      $sheet->setCellValue("L{$current}", $r['descuento']);
      $sheet->setCellValue("M{$current}", $r['total']);
      $sheet->setCellValue("N{$current}", $r['pagado']);
      $sheet->setCellValue("O{$current}", $r['pendiente']);

      $sheet->setCellValue("P{$current}", mb_strtoupper($r['vendedor']));
      $sheet->setCellValue("Q{$current}", mb_strtoupper($r['encargado']));

      // 4.3) Datos finales
      $sheet->setCellValue("R{$current}", mb_strtoupper($r['sede']));
      $sheet->setCellValue("S{$current}", mb_strtoupper($r['observacion']));     // “con igv” / “sin igv”

      $current++;
    }

    $this->formatMoneyColumns($sheet, ['F', 'G', 'H'], $firstRow, $current - 1);

    // Ajustar ancho de columna de items
    $sheet->getColumnDimension('T')->setWidth(50);
    
    // Ajustar ancho de columna de observaciones
    $sheet->getColumnDimension('S')->setWidth(20);
  }

  /* ==========================================================
   *  Formateo monetario
   * ======================================================== */
  private function formatMoneyColumns(
    \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
    array $columns,
    int $start,
    int $end
  ): void {
    foreach ($columns as $col) {
      $sheet->getStyle($col . $start . ':' . $col . $end)
        ->getNumberFormat()
        ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    }
  }

  /* ==========================================================
   *  Pagos de Contratos
   * ======================================================== */
  private function fillPaymentsSheet(
    \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
    array $rows,
    int $firstRow = 5
  ): void {
    $current = $firstRow;
    $meses = [
      '01' => 'Enero',
      '02' => 'Febrero',
      '03' => 'Marzo',
      '04' => 'Abril',
      '05' => 'Mayo',
      '06' => 'Junio',
      '07' => 'Julio',
      '08' => 'Agosto',
      '09' => 'Septiembre',
      '10' => 'Octubre',
      '11' => 'Noviembre',
      '12' => 'Diciembre'
    ];

    foreach ($rows as $idx => $r) {
      if ($idx > 0) {
        $sheet->insertNewRowBefore($current, 1);
        $sheet->duplicateStyle(
          $sheet->getStyle('A' . ($current - 1) . ':G' . ($current - 1)),
          'A' . $current . ':G' . $current
        );
      }

      $fecha = new \DateTime($r['created_at']);
      $sheet->setCellValue("A{$current}", $idx + 1);
      $sheet->setCellValue("B{$current}", $fecha->format('d/m/Y'));
      $sheet->setCellValue("C{$current}", mb_strtoupper($meses[$fecha->format('m')]));
      $sheet->setCellValue("D{$current}", $fecha->format('Y'));
      $sheet->setCellValue("E{$current}", mb_strtoupper($r['nombres'] . ' ' . $r['apellidos']));
      $sheet->setCellValue("F{$current}", $r['dni']);
      $sheet->setCellValue("G{$current}", mb_strtoupper($r['servicio']));
      $sheet->setCellValue("H{$current}", mb_strtoupper($r['trabajo']));
      $sheet->setCellValue("I{$current}", $r['monto']);
      $sheet->setCellValue("J{$current}", mb_strtoupper($r['sede']));

      $current++;
    }

    $this->formatMoneyColumns($sheet, ['I'], $firstRow, $current - 1);

    // Ajustar ancho de columnas
    $sheet->getColumnDimension('E')->setWidth(30);  // Nombre completo
    $sheet->getColumnDimension('G')->setWidth(20);  // Servicio
    $sheet->getColumnDimension('H')->setWidth(20);  // Trabajo
    $sheet->getColumnDimension('J')->setWidth(20);  // Sede
  }


  /* ==========================================================
   *  CITAS Y MANTENIMIENTO
   * ======================================================== */
  private function fillCitasMantenimientoSheet(
    \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet,
    array $rows,
    int $firstRow = 5
  ): void {
    $current = $firstRow;
    $meses = [
      '01' => 'Enero',
      '02' => 'Febrero',
      '03' => 'Marzo',
      '04' => 'Abril',
      '05' => 'Mayo',
      '06' => 'Junio',
      '07' => 'Julio',
      '08' => 'Agosto',
      '09' => 'Septiembre',
      '10' => 'Octubre',
      '11' => 'Noviembre',
      '12' => 'Diciembre'
    ];

    foreach ($rows as $idx => $r) {
      if ($idx > 0) {
        $sheet->insertNewRowBefore($current, 1);
        $sheet->duplicateStyle(
          $sheet->getStyle('A' . ($current - 1) . ':G' . ($current - 1)),
          'A' . $current . ':G' . $current
        );
      }

      $fecha = new \DateTime($r['created_at']);
      $sheet->setCellValue("A{$current}", $idx + 1);
      $sheet->setCellValue("B{$current}", $fecha->format('d/m/Y'));
      $sheet->setCellValue("C{$current}", mb_strtoupper($meses[$fecha->format('m')]));
      $sheet->setCellValue("D{$current}", $fecha->format('Y'));
      $sheet->setCellValue("E{$current}", mb_strtoupper($r['paciente']));
      $sheet->setCellValue("F{$current}", $r['dni']);
      $sheet->setCellValue("G{$current}", $r['monto']);
      $sheet->setCellValue("H{$current}", mb_strtoupper($r['sede']));

      $current++;
    }
  }
}
