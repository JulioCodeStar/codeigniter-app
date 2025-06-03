<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\CajaVentas\PagosModel;
use App\Models\CajaVentas\VentasAccesoriosModel;
use App\Models\InvoiceListModel;
use App\Models\InvoiceModel;
use CodeIgniter\API\ResponseTrait;

class AccesoriosController extends BaseController
{
  use ResponseTrait;
  protected $hoy, $invoiceModel, $accesoriosModel, $id_user, $pagosModel, $id_sede, $itemsModel;

  function __construct()
  {
    $this->invoiceModel     = new InvoiceModel();
    $this->accesoriosModel  = new VentasAccesoriosModel();
    $this->pagosModel       = new PagosModel();
    $this->itemsModel       = new InvoiceListModel();

    $this->hoy              = date('Y-m-d');
    $this->id_user          = session('caja_user')['id'];
    $this->id_sede          = session('caja_user')['sede_id'];
  }

  public function index()
  {
    $data['pagos'] = $this->pagosModel->getAllPagosByDate('venta', $this->hoy, $this->id_user, $this->id_sede);
    $data['ventas'] = $this->accesoriosModel->getAllVentasDate($this->hoy, $this->id_sede);
    return view('sales/accesorios/index', $data);
  }

  /* VIEW Nuevo Venta Accesorio */
  public function new()
  {
    $data['get']  = $this->invoiceModel->getInvoiceGroupAllVentas();
    return view('sales/accesorios/new', $data);
  }

  public function create()
  {
    try {

      $data = [
        'paciente_id'     => $this->request->getPost('paciente_id'),
        'cotizacion_id'   => $this->request->getPost('id_cotizacion'),
        'fecha_inicio'    => date('Y-m-d H:i:s'),
        'fecha_garantia'  => date('Y-m-d H:i:s', strtotime('+1 year')),
        'monto_total'     => $this->request->getPost('total'),
        'moneda'          => $this->request->getPost('moneda'),
        'user_id'         => $this->id_user,
        'sede_id'         => $this->id_sede
      ];

      $query = $this->accesoriosModel->insert($data, true);

      if ($query) {
        $data_pagos = [
          'modulo'        => 'venta',
          'referencia_id' => $query,
          'paciente_id'   => $this->request->getPost('paciente_id'),
          'tip_pago'      => $this->request->getPost('submetodo'),
          'moneda'        => $this->request->getPost('moneda'),
          'monto'         => $this->request->getPost('bono'),
          'user_id'       => $this->id_user,
          'sede_id'         => $this->id_sede
        ];

        $this->pagosModel->insert($data_pagos);

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Venta Accesorio Registrado Exitosamente',
              'redirect' => 'sales/accesorios'
            ]);
        }
      }

      return;
    } catch (\Exception $e) {
      log_message('error', 'Error al crear Venta Accesorio: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear Venta Accesorio',
            'code' => $e->getMessage()
          ]);
      }

      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  public function generatePdfAccesorios(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $accesorios = $this->accesoriosModel->getVentastById($id);
    $listInvoice = $this->itemsModel->where('cotizacion_id', $accesorios['cotizacion_id'])->findAll();

    $data = [
      'paciente' => mb_strtoupper($accesorios['nombres'] . ' ' . $accesorios['apellidos']),
      'contract_date' => $accesorios['fecha_inicio'],
      'cod_paciente' => $accesorios['cod_paciente'],
      'dni' => $accesorios['dni'],
      'direccion' => mb_strtoupper($accesorios['direccion']),
      'sede' => $accesorios['sede'],
      'logo' => base_url('assets/media/img/encabezado.png'),
      'id_coti' => $listInvoice,
      'trabajo' => mb_strtoupper($accesorios['trabajo']),
      'n_boleta' => $accesorios['n_boleta'],
    ];

    $view = 'pdf/accesorios/index';
    $html = view($view, $data);
    $header = '
    <table style="width: 100%; padding-left: 20px; padding-right: 20px;">
        <tr>
            <td style="width: 30%; text-align: left;">
                <img src="' . $data['logo'] . '" style="height: 40px;">
            </td>
            <td style="width: 40%; text-align: center;">
                
            </td>
            <td style="width: 30%; text-align: right;">
                <small style="font-style: italic; font-weight: bold;">Front Desk</small>
                <br>
                <small style="font-style: italic;">' . $data['sede'] . ', ' . fecha_dmy(date('Y-m-d')) . '</small>
                <br>
                <small style="font-style: italic; font-weight: bold;">N° boleta: ' . $data['n_boleta'] . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);
    $mpdf->WriteHTML($html);
    $mpdf->Output('accesorios_' . $accesorios['nombres'] . '_' . $accesorios['apellidos'] . '.pdf', 'I');
    exit;
  }

  /* VIEW Pagos Ventas */
  public function pagos()
  {
    $data['ventas'] = $this->accesoriosModel->getAllVentas();
    return view('sales/accesorios/pagos', $data);
  }

  public function getVentasById(int $id)
  {
    $data = $this->accesoriosModel->getVentastById($id);

    // Normalizar a array de contratos
    $isSingle = false;
    if ($data && ! isset($data[0])) {
      $data = [$data];
      $isSingle = true;
    }

    foreach ($data as &$ventas) {
      // 1) Traer todos los pagos
      $pagos = $this->accesoriosModel->getAllPagosById($ventas['id']);

      // 1.1) Formatear created_at de cada pago
      foreach ($pagos as &$pago) {
        if (isset($pago['created_at'])) {
          $pago['created_at'] = fecha_dmy($pago['created_at']);
        }
      }
      $ventas['pagos'] = $pagos;

      // 2) Sumar los montos de los pagos
      $totalPagos = array_sum(array_column($pagos, 'monto'));

      // 3) Calcular la deuda
      $montoFinal = $ventas['monto_total'] ?? 0;
      $saldo = $montoFinal - $totalPagos;
      if ($saldo <= 0) {
        $ventas['deuda'] = 'pagado';
      } else {
        $ventas['deuda'] = number_format($saldo, 2, '.', '');
      }

      // 4) Formatear fecha_inicio
      $ventas['fecha_inicio'] = fecha_dmy($ventas['fecha_inicio']);

      // 5) Evaluar garantía
      $hoy = date('Y-m-d');
      if ($ventas['fecha_garantia'] < $hoy) {
        $ventas['garantia'] = 'caducado';
      } else {
        $ventas['garantia'] = 'activa';
      }
    }

    $response = $isSingle ? $data[0] : $data;
    return $this->respond($response);
  }

  public function create_pagos()
  {
    try {

      $data = [
        'modulo'        => 'venta',
        'referencia_id' => $this->request->getPost('id_contract'),
        'paciente_id'   => $this->request->getPost('id_paciente'),
        'tip_pago'      => $this->request->getPost('submetodo'),
        'moneda'        => $this->request->getPost('moneda'),
        'monto'         => $this->request->getPost('bono'),
        'observaciones' => $this->request->getPost('observacion'),
        'user_id'       => $this->id_user,
        'sede_id'         => $this->id_sede
      ];

      $this->pagosModel->insert($data);

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(201)
          ->setJSON([
            'status'  => 201,
            'message' => 'Pago Registrado Exitosamente',
            'redirect' => 'sales/accesorios'
          ]);
      }
    } catch (\Exception $e) {
      log_message('error', 'Error al crear Pagos: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear Pago',
            'code' => $e->getMessage()
          ]);
      }

      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  public function delete_pagos(int $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->route('patient');
    }

    $this->pagosModel->delete($id);

    return redirect()->to('sales/accesorios');
  }

  public function delete_contrato(int $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->route('patient');
    }

    $delete_av = $this->accesoriosModel->delete($id);
    if ($delete_av) {
      $this->pagosModel->where('modulo', 'venta')->where('referencia_id', $id)
        ->delete();
    }

    return redirect()->to('sales/accesorios');
  }

  public function generatePdfPagosAccesorios(int $id, int $index)
  {
    $allPagos = $this->pagosModel->getPagosById($id, 'venta', $index);

    if (empty($allPagos)) {
      return redirect()->back()->with('error', 'No se encontraron pagos para esta venta');
    }

    // Filtrar los pagos hasta el número de pago solicitado
    $pagos = array_filter($allPagos, function($pago) use ($index) {
      return $pago['pago_nro'] <= $index;
    });

    // Reindexar el array para asegurar índices secuenciales
    $pagos = array_values($pagos);

    if (empty($pagos)) {
      return redirect()->back()->with('error', 'No se encontraron pagos hasta el número ' . $index);
    }

    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $data = [
      'logo' => base_url('assets/media/img/encabezado.png'),
      'paciente' => mb_strtoupper($pagos[0]['paciente']),
      'fecha_inicio' => fecha_dmy($pagos[0]['fecha_inicio']),
      'cod_paciente' => $pagos[0]['cod_paciente'],
      'dni' => $pagos[0]['dni'],
      'monto_total' => $pagos[0]['monto_total'],
      'moneda' => $pagos[0]['moneda'],
      'trabajo' => mb_strtoupper($pagos[0]['trabajo']),
      'pagos' => $pagos,
      'fecha' => fecha_dmy($pagos[$index - 1]['created_at']),
      'n_boleta' => $pagos[0]['n_boleta'],
    ];

    $pagos_view = view('pdf/accesorios/pagos', $data);

    $header = '
    <table style="width: 100%; padding-left: 20px; padding-right: 20px;">
        <tr>
            <td style="width: 30%; text-align: left;">
                <img src="' . $data['logo'] . '" style="height: 40px;">
            </td>
            <td style="width: 40%; text-align: center;">
                
            </td>
            <td style="width: 30%; text-align: right;">
                <small style="font-style: italic; font-weight: bold;">Front Desk</small>
                <br>
                <small style="font-style: italic;">Fecha: ' . fecha_dmy(date('Y-m-d')) . '</small>
                <br>
                <small style="font-style: italic; font-weight: bold;">Código: ' . $data['cod_paciente'] . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);

    $mpdf->WriteHTML($pagos_view);

    $mpdf->Output('pagos.pdf', 'I');
    exit;
  }
}
