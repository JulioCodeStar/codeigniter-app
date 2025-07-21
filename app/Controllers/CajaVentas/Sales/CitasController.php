<?php

namespace App\Controllers\CajaVentas\Sales;

use App\Controllers\BaseController;
use App\Models\CajaVentas\PagosModel;
use App\Models\PatientModel;
use CodeIgniter\API\ResponseTrait;

class CitasController extends BaseController
{
  use ResponseTrait;
  protected $pagosModel, $hoy, $pacienteModel, $id_user, $id_sede;

  function __construct()
  {
    $this->pagosModel     = new PagosModel();
    $this->pacienteModel  = new PatientModel();

    $this->hoy            = date('Y-m-d');
    $this->id_user        = session('caja_user')['id'] ?? null;
    $this->id_sede        = session('caja_user')['sede_id'] ?? null;
  }

  public function index()
  {
    $data['patient'] = $this->pacienteModel->orderBy('cod_paciente', 'DESC')->findAll();
    $data['cita']    = $this->pagosModel->getAllPagosCitas('cita', $this->hoy, $this->id_user, $this->id_sede);
    return view('sales/citas/index', $data);
  }

  public function create()
  {
    try {

      $data = [
        'modulo'        => 'cita',
        'paciente_id'   => $this->request->getPost('paciente'),
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
            'message' => 'Cita Registrado Exitosamente',
            'redirect' => 'sales/citas'
          ]);
      }
    } catch (\Exception $e) {
      log_message('error', 'Error al crear Cita: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear Cita',
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

    return redirect()->to('sales/citas');
  }

  public function generatePdfReciboCita(int $id)
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

    $data['cita'] = $this->pagosModel->getCitaById($id);

    $cita_view = view('pdf/citasMantenimiento/index', $data);

    $mpdf->WriteHTML($cita_view);
    $mpdf->Output('recibo_cita.pdf', 'I');
    exit;
  }
}
