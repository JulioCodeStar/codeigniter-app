<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\ComponentListModel;
use App\Models\ComponentsModel;
use App\Models\InvoiceListModel;
use App\Models\InvoiceModel;
use App\Models\JobModel;
use App\Models\PatientModel;
use App\Models\ServiceModel;
use CodeIgniter\API\ResponseTrait;

class InvoiceController extends BaseController
{
  use ResponseTrait;
  protected $invoiceModel;

  function __construct()
  {
    $this->invoiceModel = new InvoiceModel();
  }

  /* VIEW Listado de Cotizaciones */
  public function index()
  {
    // $data['list'] = $this->invoiceModel->findAll();
    $data['list'] = $this->invoiceModel->getInvoiceAll();
    return view('patients/invoices/index', $data);
  }

  /* VIEW Registrar Cotización */
  public function new()
  {
    $pacienteModel  = new PatientModel();
    $serviceModel   = new ServiceModel();


    $data['paciente'] = $pacienteModel->orderBy('cod_paciente', 'DESC')->findAll();
    $data['service']  = $serviceModel->orderBy('id', 'ASC')->findAll();
    return view('patients/invoices/new', $data);
  }

  public function getServiceJob(int $id)
  {
    $jobModel = new JobModel();
    $trabajo  = $jobModel->where('servicios_id', $id)->findAll();

    return $this->respond($trabajo);
  }

  public function getcomponentsIfJob(int $id)
  {
    $componentsModel = new ComponentsModel();
    $itemsModel      = new ComponentListModel();

    $components      = $componentsModel->where('job_id', $id)->findAll();

    foreach ($components as &$component) {
      $items = $itemsModel->where('component_id', $component['id'])->findAll();

      // Extraer solo el campo `items` de cada fila
      $component['items'] = array_column($items, 'items');
    }

    return $this->respond($components);
  }

  public function create()
  {
    try {

      $if_descuento = !empty($this->request->getPost('descuento')) ? 1 : 0;
      $if_igv       = ($this->request->getPost('igv_coti') == 0.00) ? 0 : 1;

      $data = [
        'paciente_id'           => $this->request->getPost('paciente_id'),
        'encargado'             => $this->request->getPost('encargado'),
        'servicios_id'          => $this->request->getPost('select-servicio'),
        'jobs_id'               => $this->request->getPost('select-trabajo'),
        'peso'                  => $this->request->getPost('peso'),
        'moneda'                => $this->request->getPost('moneda'),
        'monto'                 => $this->request->getPost('subtotal'),
        'aplica_descuento'      => $if_descuento,
        'porce_descuento'      => $this->request->getPost('descuento'),
        'descuento'             => $this->request->getPost('descuento_coti'),
        'igv'                   => $if_igv,
        'igv_valor'             => $this->request->getPost('igv_coti'),
        'monto_final'           => $this->request->getPost('total_coti'),
        'ajustes'               => $this->request->getPost('ajustes'),
        'diagnostico'           => $this->request->getPost('diagnostico'),
        'fecha_now'             => $this->request->getPost('fecha_now'),
        'fecha_exp'             => $this->request->getPost('fecha_exp'),
      ];

      $query = $this->invoiceModel->insert($data, true);

      if ($query) {
        $titles = $this->request->getPost('title');         // array
        $descriptions = $this->request->getPost('description'); // array
        $cantidades = $this->request->getPost('cantidad');

        $itemsModel = new InvoiceListModel();

        for ($i = 0; $i < count($descriptions); $i++) {
          if (trim($descriptions[$i]) && $cantidades[$i] > 0) {
            $itemsModel->insert([
              'cotizacion_id' => $query,
              'title'         => $titles[$i] ?? null,
              'descripcion'   => $descriptions[$i],
              'cantidad'      => $cantidades[$i],
            ]);
          }
        }

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Cotización creado exitosamente',
            ]);
        }
      }

      return;
    } catch (\Exception $e) {
      log_message('error', 'Error al crear cotización: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al crear cotización',
            'code' => $e->getMessage()
          ]);
      }

      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al guardar: ' . $e->getMessage());
    }
  }

  /* Eliminar Cotizacion */
  public function delete(int $id)
  {
    if (!$this->request->is('post') || $id == null) {
      return redirect()->route('invoice');
    }

    $this->invoiceModel->delete($id);

    return redirect()->to('invoice');
  }

  public function generateCotiPDF(int $id)
  {

    $datos      = $this->invoiceModel->getInvoiceById($id);
    $listModel  = new InvoiceListModel();

    $medidas = [
      'Miembro Inferior' => [
        'Toma de Medidas',
        'Prueba de Encaje',
        'Alineación y Marcha',
        'Encaje Final'
      ],
      'Miembro Superior' => [
        'Escaneo y tomas de Medida',
        'Prueba de Encaje',
        'Prueba de Función y Alineación',
        'Encaje Final'
      ],
      'Estética' => [
        'Toma de Medidad',
        'Moldeado o Escultura',
        'Prueba de Succión',
        'Encaje Final'
      ],
    ];

    // Configurar mPDF
    $mpdf = new \Mpdf\Mpdf([
      'mode' => 'utf-8',
      'format' => 'A4',
      'margin_top' => 60,
      'margin_header' => 10,
      'margin_footer' => 15
    ]);

    $logo = base_url('assets/media/img/encabezado.png');

    $template_header = '<table width="100%" style="padding-bottom: 10px; border-bottom: 1px solid #216E71; font-size: 9pt; color: #333;">
      <tr>
        <td width="30%">
            <img src="' . $logo . '" style="height: 50px;">
        </td>
        <td width="70%" style="text-align: right;">
            RUC: 20600880081<br>
            Cal. Max Palma Arrúe Nro. 1117<br>
            administracion@kypbioingenieria.com <br>
            <strong>www.kypbioingenieria.com</strong>
        </td>
      </tr>
    </table>';

    $data = [
      'template_header' => $template_header,
      'get'             => $datos,
      'list'            => $listModel->where('cotizacion_id', $id)->findAll(),
      'medidas'         => $medidas
    ];

    $html = view('pdf/cotizacion', $data);
    $mpdf->WriteHTML($html);
    $mpdf->Output('Cotizacion.pdf', 'I');
    exit;
  }

  /* View Modificar Cotización */
  public function show(int $id)
  {
    $pacienteModel  = new PatientModel();
    $serviceModel   = new ServiceModel();
    $jobsModel      = new JobModel();

    $listModel      = new InvoiceListModel();

    $data['paciente'] = $pacienteModel->orderBy('cod_paciente', 'DESC')->findAll();
    $data['service']  = $serviceModel->orderBy('id', 'ASC')->findAll();
    $data['get']      = $this->invoiceModel->getInvoiceById($id);
    $data['job']      = $jobsModel->where('servicios_id', $data['get']['id_servicio'])->findAll();
    $data['list']     = $listModel->where('cotizacion_id', $id)->findAll();
    return view('patients/invoices/show', $data);
  }

  public function edit(int $id)
  {
    try {

      $if_descuento = !empty($this->request->getPost('descuento')) ? 1 : 0;
      $if_igv       = ($this->request->getPost('igv_coti') == 0.00) ? 0 : 1;

      $data = [
        'paciente_id'           => $this->request->getPost('paciente_id'),
        'encargado'             => $this->request->getPost('encargado'),
        'servicios_id'          => $this->request->getPost('select-servicio'),
        'jobs_id'               => $this->request->getPost('select-trabajo'),
        'peso'                  => $this->request->getPost('peso'),
        'moneda'                => $this->request->getPost('moneda'),
        'monto'                 => $this->request->getPost('subtotal'),
        'aplica_descuento'      => $if_descuento,
        'porce_descuento'       => $this->request->getPost('descuento'),
        'descuento'             => $this->request->getPost('descuento_coti'),
        'igv'                   => $if_igv,
        'igv_valor'             => $this->request->getPost('igv_coti'),
        'monto_final'           => $this->request->getPost('total_coti'),
        'ajustes'               => $this->request->getPost('ajustes'),
        'diagnostico'           => $this->request->getPost('diagnostico'),
        'fecha_now'             => $this->request->getPost('fecha_now'),
        'fecha_exp'             => $this->request->getPost('fecha_exp'),
      ];

      $query = $this->invoiceModel->update($id, $data);

      if ($query) {
        $titles = $this->request->getPost('title');         // array
        $descriptions = $this->request->getPost('description'); // array
        $cantidades = $this->request->getPost('cantidad');

        $itemsModel = new InvoiceListModel();
        $itemsModel->where('cotizacion_id', $id)->delete();

        for ($i = 0; $i < count($descriptions); $i++) {
          if (trim($descriptions[$i]) && $cantidades[$i] > 0) {
            $itemsModel->insert([
              'cotizacion_id' => $id,
              'title'         => $titles[$i] ?? null,
              'descripcion'   => $descriptions[$i],
              'cantidad'      => $cantidades[$i],
            ]);
          }
        }

        if ($this->request->isAJAX()) {
          return $this->response
            ->setStatusCode(201)
            ->setJSON([
              'status'  => 201,
              'message' => 'Cotización Modificado exitosamente',
            ]);
        }
      }

      return;
    } catch (\Exception $e) {
      log_message('error', 'Error al Modificado cotización: ' . $e->getMessage());

      if ($this->request->isAJAX()) {
        return $this->response
          ->setStatusCode(500)
          ->setJSON([
            'status'  => 500,
            'message' => 'Error al Modificado cotización',
            'code' => $e->getMessage()
          ]);
      }

      return redirect()
        ->back()
        ->withInput()
        ->with('error', 'Error al Modificar: ' . $e->getMessage());
    }
  }
}
