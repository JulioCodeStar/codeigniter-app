<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ContractModel;
use App\Models\CajaVentas\PagosModel;
use CodeIgniter\API\ResponseTrait;

class ManagmentController extends BaseController
{
  use ResponseTrait;
  protected $pagosModel, $hoy, $contractModel, $id_user, $id_sede;

  function __construct()
  {
    $this->hoy              = date('Y-m-d');
    $this->id_user          = session('caja_user')['id'] ?? null;
    $this->id_sede          = session('caja_user')['sede_id'] ?? null;

    $this->pagosModel       = new PagosModel();
    $this->contractModel    = new ContractModel();
  }

  public function index() 
  {
    $data['contract']   = $this->contractModel->getAllContract();
    $data['managment']  = $this->pagosModel->getAllPagos('mantenimiento', $this->id_user, $this->hoy, $this->id_sede);
    return view('sales/managment/index', $data);  
  }

  public function create()
  {
    try {

      $raw = $this->request->getPost('paciente');

      $parts = explode('|', $raw);
      $id_paciente = (string) $parts[0];
      $id_referencia = (int) $parts[1];

      $data = [
        'modulo'        => 'mantenimiento',
        'paciente_id'   => $id_paciente,
        'referencia_id' => $id_referencia,
        'tip_pago'      => $this->request->getPost('submetodo'),
        'moneda'        => $this->request->getPost('moneda'),
        'monto'         => $this->request->getPost('bono'),
        'observaciones' => $this->request->getPost('observacion'),
        'user_id'       => $this->id_user,
        'sede_id'       => $this->id_sede
      ];

      $this->pagosModel->insert($data);

      if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Mantenimiento Registrado Exitosamente',
              'redirect' => 'sales/managment'
            ]);
      }
    } catch (\Exception $e) {
      log_message('error', 'Error al crear Mantenimiento: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear Mantenimiento',
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
      return redirect()->route('');
    }  

    $this->pagosModel->delete($id);

    return redirect()->to('sales/managment');
  }

  public function generatePdfReciboManagment(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'orientation' => 'P', // Portrait (vertical)
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_top' => 10,
      'margin_bottom' => 10,
      'margin_header' => 0,
      'margin_footer' => 0,
      'default_font_size' => 10
    ]);

    $data['cita'] = $this->pagosModel->getManagmentById($id);

    $cita_view = view('pdf/citasMantenimiento/index', $data);

    $mpdf->WriteHTML($cita_view);
    $mpdf->Output('recibo_mantenimiento.pdf', 'I');
    exit;
  }

}