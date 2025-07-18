<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\RequirementsModel;
use App\Models\SedeModel;
use App\Models\AreaModel;
use App\Models\Inventory\AreaModel as InventoryAreaModel;
use App\Models\Inventory\ProductsModel;
use App\Models\PatientModel;
use CodeIgniter\HTTP\ResponseInterface;

class RequirementsController extends BaseController
{
    protected $requirementsModel, $sedeModel, $areaModel, $productModel, $pacienteModel, $db;

    public function __construct()
    {
        $this->requirementsModel = new RequirementsModel();
        $this->sedeModel         = new SedeModel();
        $this->areaModel         = new InventoryAreaModel();
        $this->productModel      = new ProductsModel();
        $this->pacienteModel     = new PatientModel();
        $this->db                = \Config\Database::connect();
    }

    public function index()
    {
        $requirements = $this->requirementsModel
            ->select('inventory_requirements.*, areas.nombres as area_solicitante')
            ->join('areas', 'areas.id = inventory_requirements.area_solicitante')
            ->where('sede_origen', session('inventory_user')['sede_id'])
            ->findAll();
        $sedes        = $this->sedeModel->find(session('inventory_user')['sede_id']);

        $countRequirements = $this->requirementsModel
            ->where('sede_origen', session('inventory_user')['sede_id'])
            ->countAllResults();

        $countRequirementsPending = $this->requirementsModel
            ->where('sede_origen', session('inventory_user')['sede_id'])
            ->where('estado', 'pendiente')
            ->countAllResults();

        $countRequirementsApproved = $this->requirementsModel
            ->where('sede_origen', session('inventory_user')['sede_id'])
            ->where('estado', 'aprobado')
            ->countAllResults();

        $countRequirementsTransit = $this->requirementsModel
            ->where('sede_origen', session('inventory_user')['sede_id'])
            ->where('estado', 'en transito')
            ->countAllResults();

        if (session('inventory_user')['sede_id'] == 1) {
            return redirect()->to(base_url('inventory'));
        } else {
            return view('inventory/requirements/index', [
                'requirements' => $requirements,
                'sedes' => $sedes,
                'countRequirements' => $countRequirements,
                'countRequirementsPending' => $countRequirementsPending,
                'countRequirementsApproved' => $countRequirementsApproved,
                'countRequirementsTransit' => $countRequirementsTransit,
            ]);
        }
    }

    public function new()
    {

        $sedes        = $this->sedeModel->find(session('inventory_user')['sede_id']);
        $areas        = $this->areaModel->findAll();
        $products     = $this->productModel->findAll();
        $patients     = $this->pacienteModel->findAll();

        if (session('inventory_user')['sede_id'] == 1) {
            return redirect()->to(base_url('inventory'));
        } else {
            return view('inventory/requirements/new', [
                'sedes' => $sedes,
                'areas' => $areas,
                'products' => $products,
                'patients' => $patients,
            ]);
        }
    }

    public function create()
    {
        try {
            $post = $this->request->getPost();
            $sede_destino = $this->sedeModel->where('sucursal', 'Lima')->first();
            $items = json_decode($post['items'], true) ?? [];
            $this->db->transStart();

            $data =  [
                'area_solicitante' => $post['area'],
                'nombre_solicitante' => $post['solicitante'],
                'fecha_entrega' => $post['fecha_entrega'],
                'sede_origen' => session('inventory_user')['sede_id'],
                'sede_destino' => $sede_destino['id'],
                'items' => json_encode($items),
                'estado' => 'pendiente'
            ];

            $requirementId = $this->requirementsModel->insert($data);
            if (!$requirementId) {
                log_message('error', 'RequirementsModel errors: ' . print_r($this->requirementsModel->errors(), true));
                log_message('error', 'DB error: ' . json_encode($this->db->error()));
                throw new \RuntimeException('No se pudo crear el requerimiento.');
            }

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \RuntimeException('Error en transacción, se hizo rollback.');
            }


            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'status'  => 200,
                    'message' => 'Requerimiento creado exitosamente',
                    'requirementId' => $requirementId
                ]);
            }
            return redirect()
                ->to(base_url('inventory/requirements'))
                ->with('success', 'Requerimiento creado exitosamente');
        } catch (\Exception $e) {
            // Rollback manual por si acaso
            if ($this->db->transStatus() !== false) {
                $this->db->transRollback();
            }
            log_message('error', 'Error create(): ' . $e->getMessage());
            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear el requerimiento: ' . $e->getMessage(),
                    ]);
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            // 1) Obtener cabecera
            $requirement = $this->requirementsModel
                ->select('inventory_requirements.*, areas.nombres as area_solicitante, sedes.sucursal as sede_origen, sedes2.sucursal as sede_destino')
                ->join('areas', 'areas.id = inventory_requirements.area_solicitante')
                ->join('sedes', 'sedes.id = inventory_requirements.sede_origen')
                ->join('sedes as sedes2', 'sedes2.id = inventory_requirements.sede_destino')
                ->find($id);
            if (! $requirement) {
                return $this->response
                    ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 404, 'message' => 'Requerimiento no encontrado']);
            }

            // 2) Decodificar JSON de items
            $rawItems = json_decode($requirement['items'], true) ?? [];

            // 3) Para cada ítem, enriquecer con código/nombre de producto y resolver descripción
            $details = [];
            foreach ($rawItems as $i => $item) {
                // … ya tenías esto …
                $prod = $this->productModel->select('codigo,nombre')->find($item['product_id']);

                // Resuelves descripción
                $desc = $item['descripcion'];
                if ($item['tipo'] === 'Paciente' && !empty($desc)) {
                    $pac = $this->pacienteModel
                        ->select('cod_paciente,nombres,apellidos')
                        ->where('id', $desc)
                        ->first();
                    if ($pac) {
                        $desc = $pac['nombres'] . ' ' . $pac['apellidos'];
                    }
                }

                $details[] = [
                    'id'          => $i + 1,                    // índice como “#”
                    'producto'    => $prod['nombre']   ?? '',
                    'tipo'        => $item['tipo'],             // <-- aquí
                    'descripcion' => $desc,                     // texto resuelto
                    'cantidad'    => (int)$item['cantidad'],
                ];
            }

            // 4) Responder JSON
            return $this->response->setJSON([
                'status'      => 200,
                'requirement' => $requirement,
                'details'     => $details,
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error show(): ' . $e->getMessage());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al obtener el requerimiento: ' . $e->getMessage(),
                ]);
        }
    }

    public function delete(int $id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->route('inventory/requirements');
        }

        $this->requirementsModel->delete($id);

        return redirect()->to('inventory/requirements');
    }

    public function generatePDF(int $id)
    {
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'helvetica',
            'margin_top' => 25,
            'margin_bottom' => 15,
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_header' => 10,
            'margin_footer' => 10,
            'orientation' => 'P'
        ]);


        // Header del PDF
        $mpdf->SetHTMLHeader($this->getHTMLHeader());

        // Footer del PDF
        $mpdf->SetHTMLFooter($this->getHTMLFooter());

        $data = $this->requirementsModel
            ->select('inventory_requirements.*, areas.nombres as area, sedes.sucursal as sede_origen, sedes2.sucursal as sede_destino')
            ->join('areas', 'areas.id = inventory_requirements.area_solicitante')
            ->join('sedes', 'sedes.id = inventory_requirements.sede_origen')
            ->join('sedes as sedes2', 'sedes2.id = inventory_requirements.sede_destino')
            ->where('inventory_requirements.id', $id)
            ->first();

        $productNames = array_column($this->productModel->findAll(), 'nombre', 'id');
        $pacienteNames = []; // Aquí irán los pacientes que necesites

        // Si quieres cargar solo los pacientes que aparecen en el JSON:
        $pacienteIds = array_column(json_decode($data['items'], true), 'descripcion');
        $pacientes = $this->pacienteModel
            ->select('id, CONCAT(nombres, " ", apellidos) AS nombre_completo')
            ->whereIn('id', $pacienteIds)
            ->findAll();

        $pacienteNames = array_column($pacientes, 'nombre_completo', 'id');

        $html = view('pdf/inventory/requirements/index', [
            ...$data,
            'productNames' => $productNames,
            'pacienteNames' => $pacienteNames,
            'items' => json_decode($data['items'], true)
        ]);

        // Escribir HTML al PDF
        $mpdf->WriteHTML($html);

        // Generar nombre del archivo
        $filename = 'requerimiento_' . $id . '.pdf';

        // Mostrar PDF en el navegador
        $mpdf->Output($filename, 'I');

        exit;
    }

    private function getHTMLHeader()
    {
        return '
            <div style="width: 100%; padding: 0 20px; border-bottom: 2px solid #216E71; padding-bottom: 15px;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 70%; text-align: left; vertical-align: bottom;">
                            <div style="font-size: 20pt; font-weight: bold; color: #216E71;">Orden de Requerimiento</div>
                            <div style="margin-top: 5px; font-size: 12pt;">
                                <span><strong>Referencia de Requerimiento:</strong></span>
                            </div>
                        </td>
                        <td style="width: 30%; text-align: right; vertical-align: bottom;">
                            <img src="' . base_url('assets/media/img/encabezado.png') . '" style="height: 50px; max-width: 150px;">
                        </td>
                    </tr>
                </table>
            </div>
        ';
    }

    private function getHTMLFooter()
    {
        return '
            <div style="width: 100%; border-top: 1px solid #216E71; padding-top: 10px; font-size: 9pt; text-align: center; color: #666;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; text-align: left;"></td>
                        <td style="width: 50%; text-align: right;">
                            Página {PAGENO} de {nbpg}
                        </td>
                    </tr>
                </table>
            </div>
        ';
    }
}
