<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\InvoiceListModel;
use App\Models\InvoiceModel;
use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use CodeIgniter\API\ResponseTrait;

class ContractController extends BaseController
{
  use ResponseTrait;
  protected $hoy, $pagosModel, $contractModel, $invoiceModel, $itemsModel, $id_user, $sede_id;

  public function __construct()
  {
    $this->pagosModel = new PagosModel();
    $this->contractModel = new ContractModel();
    $this->invoiceModel = new InvoiceModel();
    $this->itemsModel = new InvoiceListModel();

    $this->hoy = date('Y-m-d');
    $this->id_user = session('caja_user')['id'];
    $this->sede_id = session('caja_user')['sede_id'];
  }

  public function index()
  {

    $data['pagos'] = $this->pagosModel->getAllPagos('contrato', $this->id_user, $this->hoy, $this->sede_id);
    $data['contrato'] = $this->contractModel->getAllContractDate($this->hoy, $this->sede_id);


    $data['numContract'] = $this->contractModel->where('sede_id', $this->sede_id)->where("DATE(created_at) = '{$this->hoy}'", null, false)->countAllResults();
    $data['numPagos'] = $this->pagosModel->where('sede_id', $this->sede_id)->where('modulo', 'contrato')->where("DATE(created_at) = '{$this->hoy}'", null, false)->countAllResults();
    return view('sales/contract/index', $data);
  }

  public function new()
  {
    $data['get']  = $this->invoiceModel->getInvoiceGroupAll();

    return view('sales/contract/new', $data);
  }

  public function getListInvoice(string $id)
  {

    $list = $this->invoiceModel->getInvoiceByPatient($id);

    foreach ($list as &$row) {
      $items = $this->itemsModel->where('cotizacion_id', $row['id'])->findAll();

      $row['items'] = array_map(function ($item) {
        return $item['title'] . ': ' . $item['descripcion'];
      }, $items);

      $row['fecha_formateada'] = fecha_spanish($row['fecha_now']);
    }

    return $this->respond($list);
  }

  public function getDataInvoiceByID(int $id)
  {
    $data = $this->invoiceModel->find($id);

    return $this->respond($data);
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
        'sede_id'         => $this->sede_id,
      ];

      $query = $this->contractModel->insert($data, true);

      if ($query) {
        $data_pagos = [
          'modulo'        => 'contrato',
          'referencia_id' => $query,
          'paciente_id'   => $this->request->getPost('paciente_id'),
          'tip_pago'      => $this->request->getPost('submetodo'),
          'moneda'        => $this->request->getPost('moneda'),
          'monto'         => $this->request->getPost('bono'),
          'user_id'       => $this->id_user,
          'sede_id'         => $this->sede_id,
        ];

        $this->pagosModel->insert($data_pagos);

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Contrato Registrado Exitosamente',
              'redirect' => 'sales/contract'
            ]);
        }
      }

      return;
    } catch (\Exception $e) {
      log_message('error', 'Error al crear Contrato: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear Contrato',
            'code' => $e->getMessage()
          ]);
      }

      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  public function generatePdfContract(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $contract = $this->contractModel->getContractById($id);

    $listInvoice = $this->itemsModel->where('cotizacion_id', $contract['cotizacion_id'])->findAll();

    $data = [
      'paciente' => mb_strtoupper($contract['nombres'] . ' ' . $contract['apellidos']),
      'contract_date' => $contract['fecha_inicio'],
      'cod_paciente' => $contract['cod_paciente'],
      'dni' => $contract['dni'],
      'direccion' => mb_strtoupper($contract['direccion']),
      'sede' => $contract['sede'],
      'logo' => base_url('assets/media/img/encabezado.png'),
      'id_coti' => $listInvoice,
      'peso' => $contract['peso'],
      'ajustes' => $contract['ajustes'],
      'trabajo' => mb_strtoupper($contract['trabajo']),
    ];

    $viewMap = [
      1 => 'pdf/contract/superior/contract',
      2 => 'pdf/contract/inferior/contract',
    ];

    if (!array_key_exists($contract['servicios_id'], $viewMap)) {
      throw new \Exception("Tipo de ficha inválido: " . $contract['servicios_id']);
    }

    $ficha = $viewMap[$contract['servicios_id']];

    $contract = view($ficha, $data);

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

    $mpdf->WriteHTML($contract);

    $mpdf->Output('contrato.pdf', 'I');
    exit;
  }

  /* View Pagos */
  public function pagos()
  {

    $data['contract'] = $this->contractModel->getAllContract();

    return view('sales/contract/pagos', $data);
  }

  public function getContractById(int $id)
  {
    $data = $this->contractModel->getContractById($id);

    // Normalizar a array de contratos
    $isSingle = false;
    if ($data && ! isset($data[0])) {
      $data = [$data];
      $isSingle = true;
    }

    foreach ($data as &$contract) {
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

    $response = $isSingle ? $data[0] : $data;
    return $this->respond($response);
  }

  public function create_pagos()
  {
    try {
      $data = [
        'modulo'        => 'contrato',
        'referencia_id' => $this->request->getPost('id_contract'),
        'paciente_id'   => $this->request->getPost('id_paciente'),
        'tip_pago'      => $this->request->getPost('submetodo'),
        'moneda'        => $this->request->getPost('moneda'),
        'monto'         => $this->request->getPost('bono'),
        'observaciones' => $this->request->getPost('observacion'),
        'user_id'       => $this->id_user,
        'sede_id'       => $this->sede_id,
      ];

      $this->pagosModel->insert($data);

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(201)
          ->setJSON([
            'status'  => 201,
            'message' => 'Pago Registrado Exitosamente',
            'redirect' => 'sales/contract'
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

    return redirect()->to('sales/contract');
  }

  public function delete_contrato(int $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->route('patient');
    }

    $delete_av = $this->contractModel->delete($id);
    if ($delete_av) {
      $this->pagosModel->where('modulo', 'contrato')->where('referencia_id', $id)
        ->delete();
    }

    return redirect()->to('sales/contract');
  }

  public function generatePdfPagosContract(int $id, int $index)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $allPagos = $this->pagosModel->getPagosById($id, 'contrato', $index);
    
    // Filtrar los pagos hasta el número de pago solicitado
    $pagos = array_filter($allPagos, function($pago) use ($index) {
      return $pago['pago_nro'] <= $index;
    });

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
    ];

    $pagos_view = view('pdf/contract/pagos', $data);

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
