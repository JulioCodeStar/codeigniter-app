<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\PatientModel;

class PatientController extends BaseController
{
  protected $patientModel;

  function __construct()
  {
    $this->patientModel = new PatientModel();
  }

  /* View Listado de Pacientes */
  public function index()
  {
    $data['list'] = $this->patientModel->findAll();
    return view('patients/listado', $data);
  }


  /* View Registro de Pacientes */
  public function new()
  {
    return view('patients/new');
  }

  public function create()
  {
    try {
      // 1. Recolectar datos
      $data = [
        'nombres'              => $this->request->getPost('nombres'),
        'apellidos'            => $this->request->getPost('apellidos'),
        'dni'                  => $this->request->getPost('dni'),
        'edad'                 => $this->request->getPost('edad'),
        'genero'               => $this->request->getPost('genero'),
        'contacto'             => $this->request->getPost('contacto'),
        'fecha_nacimiento'     => $this->request->getPost('fecha_nac'),
        'sede'                 => $this->request->getPost('sede'),
        'direccion'            => $this->request->getPost('direccion'),
        'distrito'             => $this->request->getPost('distrito'),
        'email'                => $this->request->getPost('correo'),
        'vendedor'             => $this->request->getPost('vendedor'),
        'otro_contacto'        => $this->request->getPost('otro_contacto'),
        'canal'                => $this->request->getPost('canal'),
        'time_ampu'            => $this->request->getPost('tiempo_ampu'),
        'motivo_amputacion'    => $this->request->getPost('motivo'),
        'afecciones'           => $this->request->getPost('afecciones'),
        'alergias'             => $this->request->getPost('alergias'),
        'observaciones'        => $this->request->getPost('observacion'),
      ];

      // 2. Insertar
      $insertId = $this->patientModel->insert($data);

      // 3. Responder según el tipo de petición
      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(201)
          ->setJSON([
            'status'  => 201,
            'message' => 'Paciente creado exitosamente',
            'id'      => $insertId,
          ]);
      }

      // 4. Flujo no-AJAX
      return redirect()
        ->to(base_url('patient'))
        ->with('success', 'Paciente creado exitosamente');
    } catch (\Exception $e) {
      // 5. Loguear error
      log_message('error', 'Error al crear paciente: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear paciente',
          ]);
      }

      // 6. Flujo no-AJAX con flashdata de error
      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }


  /* View Edición de Pacientes */
  public function show($id)
  {
    $data['id'] = $id;
    $data['get'] = $this->patientModel->find($id);
    return view('patients/show', $data);
  }

  public function edit($id)
  {
    try {
      // 1. Recolectar datos
      $data = [
        'nombres'             => $this->request->getPost('nombres'),
        'apellidos'           => $this->request->getPost('apellidos'),
        'dni'                  => $this->request->getPost('dni'),
        'edad'                 => $this->request->getPost('edad'),
        'genero'               => $this->request->getPost('genero'),
        'contacto'             => $this->request->getPost('contacto'),
        'fecha_nacimiento'     => $this->request->getPost('fecha_nac'),
        'sede'                 => $this->request->getPost('sede'),
        'direccion'            => $this->request->getPost('direccion'),
        'distrito'             => $this->request->getPost('distrito'),
        'email'                => $this->request->getPost('correo'),
        'vendedor'             => $this->request->getPost('vendedor'),
        'otro_contacto'        => $this->request->getPost('otro_contacto'),
        'canal'                => $this->request->getPost('canal'),
        'time_ampu'            => $this->request->getPost('tiempo_ampu'),
        'motivo_amputacion'    => $this->request->getPost('motivo'),
        'afecciones'           => $this->request->getPost('afecciones'),
        'alergias'             => $this->request->getPost('alergias'),
        'observaciones'        => $this->request->getPost('observacion'),
      ];

      // 2. Insertar
      $insertId = $this->patientModel->update($id, $data);

      // 3. Responder según el tipo de petición
      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(201)
          ->setJSON([
            'status'  => 201,
            'message' => 'Paciente Actualizado exitosamente',
            'id'      => $insertId,
          ]);
      }

      // 4. Flujo no-AJAX
      return redirect()
        ->to(base_url('patient'))
        ->with('success', 'Paciente Actualizado exitosamente');
    } catch (\Exception $e) {
      // 5. Loguear error
      log_message('error', 'Error al Actualizar paciente: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al Actualizar paciente',
          ]);
      }

      // 6. Flujo no-AJAX con flashdata de error
      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  /* Eliminar Pacientes */
  public function delete(string $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->route('patient');
    }

    $this->patientModel->delete($id);

    return redirect()->to('patient');
  }

  /* Vie Ficha Técnica mPDF */
  public function generarPDF(string $id)
  {

    $patient = $this->patientModel->find($id);
    // Configurar PDF
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10
    ]);

    // Obtener datos
    $data = [
      'paciente' => $patient,
      'codigo' => $patient['cod_paciente'],
      'fecha' => $patient['created_at'],
      'logo' => base_url('assets/media/img/encabezado.png')
    ];

    // Cargar vistas
    $ficha = view('pdf/ficha_tecnica', $data);
    $consentimiento = view('pdf/consentimiento', $data);

    // Configurar encabezado
    $header = '
    <table style="width: 100%;">
        <tr>
            <td style="width: 30%; text-align: left;">
                <small style="font-weight: bold;">Código: ' . $data['codigo'] . '</small>
            </td>
            <td style="width: 40%; text-align: center;">
                <img src="' . $data['logo'] . '" style="height: 40px;">
            </td>
            <td style="width: 30%; text-align: right;">
                <small style="font-style: italic; font-weight: bold;">Front Desk</small>
                <br>
                <small>Registro: ' . fecha_dmy($data['fecha']) . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);

    // Generar PDF
    $mpdf->WriteHTML($ficha);
    $mpdf->AddPage(); // Nueva página para el consentimiento
    $mpdf->WriteHTML($consentimiento);

    // Salida
    $mpdf->Output('ficha_tecnica_' . $patient['nombres'] . '_'. $patient['apellidos'] . '.pdf', 'I');
    exit;
  }
}
