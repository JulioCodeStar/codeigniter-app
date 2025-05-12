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

  public function index()
  {
    $pagosModel = new PagosModel();
    $contratosModel = new ContractModel();

    $data['pagos'] = $pagosModel->getAllPagos('contrato');
    $data['contrato'] = $contratosModel->getAllContract();

    return view('sales/contract/index', $data);
  }

  public function new()
  {
    $invoiceModel = new InvoiceModel();
    $data['get']  = $invoiceModel->getInvoiceGroupAll();

    return view('sales/contract/new', $data);
  }

  public function getListInvoice(string $id)
  {
    $invoiceModel = new InvoiceModel();
    $itemsModel   = new InvoiceListModel();

    $list = $invoiceModel->getInvoiceByPatient($id);

    foreach ($list as &$row) {
      $items = $itemsModel->where('cotizacion_id', $row['id'])->findAll();

      $row['items'] = array_map(function ($item) {
        return $item['title'] . ': ' . $item['descripcion'];
      }, $items);

      $row['fecha_formateada'] = fecha_spanish($row['fecha_now']);
    }

    return $this->respond($list);
  }

  public function getDataInvoiceByID(int $id)
  {
    $invoiceModel = new InvoiceModel();

    $data = $invoiceModel->find($id);

    return $this->respond($data);
  }

  public function create()
  {
    try {

      $contratoModel = new ContractModel();
      $pagosModel    = new PagosModel();

      $data = [
        'paciente_id'     => $this->request->getPost('paciente_id'),
        'cotizacion_id'   => $this->request->getPost('id_cotizacion'),
        'fecha_inicio'    => date('Y-m-d H:i:s'),
        'fecha_garantia'  => date('Y-m-d H:i:s', strtotime('+1 year')),
        'monto_total'     => $this->request->getPost('total'),
        'moneda'          => $this->request->getPost('moneda'),
      ];

      $query = $contratoModel->insert($data, true);

      if ($query) {
        $data_pagos = [
          'modulo'        => 'contrato',
          'referencia_id' => $query,
          'paciente_id'   => $this->request->getPost('paciente_id'),
          'tip_pago'      => $this->request->getPost('submetodo'),
          'moneda'        => $this->request->getPost('moneda'),
          'monto'         => $this->request->getPost('bono'),
        ];

        $pagosModel->insert($data_pagos);

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Contrato Registrado Exitosamente',
              'redirect'=> 'sales/contract'
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

  /* View Pagos */
  public function pagos() 
  {
    $contratoModel = new ContractModel();
    $data['contract'] = $contratoModel->getAllContract();
    return view('sales/contract/pagos', $data); 
  }
}
