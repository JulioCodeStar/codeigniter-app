<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ContractModel;
use App\Models\Patient\ConsentimientoModel;

class ConsentimientoController extends BaseController
{
  protected $contractModel;
  protected $consentimientoModel;
  function __construct()
  {
    $this->contractModel = new ContractModel();
    $this->consentimientoModel = new ConsentimientoModel();
  }

  public function index()
  {
    $data['contract'] = $this->contractModel->getAllContract();
    return view('patients/CartaConsen/index', $data);
  }

  public function show(int $id)
  {

    $get_data_contract = $this->contractModel->getContractById($id);
    $data = [
      'paciente' => mb_strtoupper($get_data_contract['nombres'] . ' ' . $get_data_contract['apellidos']),
      'trabajo' => mb_strtoupper($get_data_contract['trabajo']),
      'cod_paciente' => $get_data_contract['cod_paciente'],
      'id' => $id,
    ];

    $exist = $this->consentimientoModel->where('contrato_id', $id)->first();

    if ($exist) {
      $data['consentimiento'] = $exist;
      return view('patients/CartaConsen/show-consen', $data);
    } else {
      return view('patients/CartaConsen/show', $data);
    }
  }

  public function create()
  {
    try {
      $post = $this->request->getPost();

      // Obtener array de descripciones
      $descripciones = $post['description'] ?? [];

      // Filtrar vacíos y construir estructura
      $items = [];
      foreach ($descripciones as $desc) {
        $desc = trim($desc);
        if (!empty($desc)) {
          $items[] = [
            'descripcion' => $desc
          ];
        }
      }

      // Validación opcional: evitar guardar sin ítems
      if (empty($items)) {
        return $this->response->setJSON([
          'status'  => 400,
          'message' => 'Debe ingresar al menos un ítem con descripción válida.'
        ]);
      }

      $contratoId = $post['contrato_id'];
      $contrato = $this->contractModel->find($contratoId);

      if (!$contrato) {
        return $this->response->setJSON([
          'status' => 404,
          'message' => 'El contrato asociado no existe.'
        ]);
      }


      // Construcción de datos a guardar
      $data = [
        'contrato_id'   => $post['contrato_id'],
        'fecha_entrega' => $post['fecha_entrega'],
        'items'         => json_encode($items),
      ];

      $this->consentimientoModel->insert($data);

      return $this->response->setStatusCode(201)->setJSON([
        'status'  => 201,
        'message' => 'Consentimiento creado correctamente.',
      ]);
    } catch (\Exception $e) {
      return $this->response->setStatusCode(500)->setJSON([
        'status'  => 500,
        'message' => 'Error interno al guardar.',
        'error'   => $e->getMessage()
      ]);
    }
  }

  public function update(int $id)
  {
    try {
      $post = $this->request->getPost();

      $descripciones = $post['description'] ?? [];

      // Filtrar vacíos y construir estructura
      $items = [];
      foreach ($descripciones as $desc) {
        $desc = trim($desc);
        if (!empty($desc)) {
          $items[] = [
            'descripcion' => $desc
          ];
        }
      }

      $data = [
        'fecha_entrega' => $post['fecha_entrega'],
        'created_at'    => $post['created_at'],
        'items'         => json_encode($items),
      ];

      $this->consentimientoModel->update($id, $data);

      return $this->response->setStatusCode(201)->setJSON([
        'status'  => 201,
        'message' => 'Consentimiento actualizado correctamente.',
      ]);
    } catch (\Exception $e) {
      return $this->response->setStatusCode(500)->setJSON([
        'status'  => 500,
        'message' => 'Error interno al Actualizar.',
        'error'   => $e->getMessage()
      ]);
    }
  }

  public function carta_provisional(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $consen = $this->consentimientoModel->getConsentimientoById($id);

    $data = [
      'paciente'  => mb_strtoupper($consen['nombres'] . ' ' . $consen['apellidos']),
      'trabajo'   => mb_strtoupper($consen['trabajo']),
      'dni'       => $consen['dni'],
      'items'     => json_decode($consen['items'], true),
      'logo'      => base_url('assets/media/img/encabezado.png'),
      'sede'      => $consen['sede'],
    ];

    $view = 'pdf/Consentimiento/index';
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
                <small style="font-style: italic;">' . $data['sede'] . ', ' . fecha_spanish(date('Y-m-d')) . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);

    $mpdf->WriteHTML($html);
    $mpdf->Output('carta_consen_' . $consen['nombres'] . '_' . $consen['apellidos'] . '.pdf', 'I');
    exit;
  }

  public function carta_entrega(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $consen = $this->consentimientoModel->getConsentimientoById($id);

    $data = [
      'paciente'  => mb_strtoupper($consen['nombres'] . ' ' . $consen['apellidos']),
      'trabajo'   => mb_strtoupper($consen['trabajo']),
      'dni'       => $consen['dni'],
      'items'     => json_decode($consen['items'], true),
      'logo'      => base_url('assets/media/img/encabezado.png'),
      'sede'      => $consen['sede'],
    ];

    $view = 'pdf/Consentimiento/carta_final';
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
                <small style="font-style: italic;">' . $data['sede'] . ', ' . fecha_spanish(date('Y-m-d')) . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);

    $mpdf->WriteHTML($html);
    $mpdf->Output('carta_entrega_' . $consen['nombres'] . '_' . $consen['apellidos'] . '.pdf', 'I');
    exit;
  }

  public function carta_imagen(int $id)
  {
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'font' => 'arial',
      'margin_top' => 15,
      'margin_header' => 10,
      'margin_footer' => 10,
    ]);

    $consen = $this->consentimientoModel->getConsentimientoById($id);

    $data = [
      'paciente'  => mb_strtoupper($consen['nombres'] . ' ' . $consen['apellidos']),
      'trabajo'   => mb_strtoupper($consen['trabajo']),
      'dni'       => $consen['dni'],
      'direccion' => $consen['direccion'],
      'items'     => json_decode($consen['items'], true),
      'logo'      => base_url('assets/media/img/encabezado.png'),
      'sede'      => $consen['sede'],
    ];

    $view = 'pdf/Consentimiento/imagen';
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
                <small style="font-style: italic;">' . $data['sede'] . ', ' . fecha_spanish(date('Y-m-d')) . '</small>
            </td>
        </tr>
    </table>';

    $mpdf->SetHTMLHeader($header);

    $mpdf->WriteHTML($html);
    $mpdf->Output('carta_imagen_' . $consen['nombres'] . '_' . $consen['apellidos'] . '.pdf', 'I');
    exit;
  }
}
