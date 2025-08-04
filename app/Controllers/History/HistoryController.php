<?php

namespace App\Controllers\History;

use App\Controllers\BaseController;
use App\Models\CajaVentas\ContractModel;
use App\Models\History\PatientProcessModel;
use App\Models\History\ProcessServiceModel;
use App\Models\History\RegisterImagesModel;
use App\Models\History\RegisterProcessModel;
use CodeIgniter\HTTP\ResponseInterface;

class HistoryController extends BaseController
{
    protected $db, $contractModel, $historyPatientProcessModel, $registerProcessModel, $registerImageModel, $historyProcessServiceModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->contractModel = new ContractModel();
        $this->historyPatientProcessModel = new PatientProcessModel();
        $this->registerProcessModel = new RegisterProcessModel();
        $this->registerImageModel = new RegisterImagesModel();
        $this->historyProcessServiceModel = new ProcessServiceModel();
    }

    public function index()
    {
        $builder = $this->db->table('contratos c')
            ->select([
                'c.id AS contrato_id',
                "CONCAT(p.nombres, ' ', p.apellidos) AS paciente",
                "p.cod_paciente",
                's.descripcion AS servicio',
                'j.descripcion AS trabajo',
                // Estado del contrato según sus procesos
                "CASE WHEN SUM(pp.status = 'en_proceso') > 0 THEN 'En Proceso' ELSE 'Finalizado' END AS estado_general",
                // Nombre del paso activo
                "MAX(CASE WHEN pp.process_id = (SELECT MAX(pp2.process_id) FROM history_patient_process pp2 WHERE pp2.contract_id = pp.contract_id) THEN ps.nombre END) AS proceso_actual"
            ])
            ->join('pacientes p',            'p.id = c.paciente_id')
            ->join('cotizaciones cot',       'cot.id = c.cotizacion_id')
            ->join('servicios s',            's.id = cot.servicios_id')
            ->join('jobs j',                 'j.id = cot.jobs_id')
            ->join('history_patient_process pp',   'pp.contract_id = c.id')
            ->join('history_process_services ps',   'ps.id = pp.process_id')
            ->groupBy('c.id')
            ->orderBy('p.apellidos', 'ASC');

        // 3. Ejecutar
        $historial = $builder->get()->getResult();

        return view('patients/history/index', compact('historial'));
    }

    public function viewResumen(int $id)
    {
        $getData = $this->contractModel
            ->select([
                'CONCAT(p.nombres, " ", p.apellidos) AS paciente',
                'p.cod_paciente',
                's.descripcion AS servicio',
                'j.descripcion AS trabajo',
                'pp.proceso_actual',
                // Estado general según sus procesos
                "CASE WHEN pp.status = 'en_proceso' THEN 'En Proceso' ELSE 'Completado' END AS estado_general",
                "ps.nombre AS proceso_actual"
            ])
            ->join('pacientes p', 'p.id = contratos.paciente_id', 'left')
            ->join('cotizaciones ct', 'ct.id = contratos.cotizacion_id', 'left')
            ->join('servicios s', 's.id = ct.servicios_id', 'left')
            ->join('jobs j', 'j.id = ct.jobs_id', 'left')
            ->join('history_patient_process pp',   'pp.contract_id = contratos.id', 'left')
            ->join('history_process_services ps',   'ps.id = pp.process_id', 'left')
            ->orderBy('pp.id', 'DESC')
            ->find($id);

        $builder = $this->db->table('history_patient_process pp')
            ->select([
                'pp.id',
                'ps.nombre         AS proceso',
                'pp.status         AS estado_raw',
                "CASE WHEN pp.status = 'en_proceso' THEN 'En Proceso' ELSE 'Completado' END AS estado",
                // Para contar registros clínicos de ese paso
                'COUNT(rp.id)      AS registros'
            ])
            ->join('history_process_services ps', 'ps.id = pp.process_id', 'left')
            ->join('history_register_process rp',      'rp.history_patient_process_id = pp.id', 'left')
            ->where('pp.contract_id', $id)
            ->groupBy('pp.id')
            ->orderBy('ps.order', 'ASC');


        $processes = $builder->get()->getResult();

        $historyRegisters = $this->db->table('history_register_process rp')
            ->select([
                'rp.id',
                'rp.fecha_register     AS fecha',
                'ps.nombre             AS proceso',
                'rp.evaluacion         AS evaluacion_tecnica',
                'rp.diagnostico        AS diagnostico_tecnico',
                'COUNT(ri.id)          AS imagenes'
            ])
            ->join('history_patient_process pp',        'pp.id = rp.history_patient_process_id', 'inner')
            ->join('history_process_services ps',        'ps.id = pp.process_id',        'left')
            ->join('history_register_images ri',  'ri.history_register_process_id = rp.id', 'left')
            ->where('pp.contract_id', $id)
            ->groupBy('rp.id')
            ->orderBy('rp.fecha_register', 'DESC')
            ->get()
            ->getResult();

        return view('patients/history/history', compact('getData', 'processes', 'historyRegisters'));
    }

    public function new(int $id)
    {
        $getData = $this->historyPatientProcessModel
            ->select('history_patient_process.id, hps.nombre, CONCAT(p.nombres, " ", p.apellidos) AS paciente, p.cod_paciente')
            ->join('history_process_services hps', 'hps.id = history_patient_process.process_id', 'left')
            ->join('contratos c', 'c.id = history_patient_process.contract_id', 'left')
            ->join('pacientes p', 'p.id = c.paciente_id', 'left')
            ->where('history_patient_process.id', $id)
            ->first();
        return view('patients/history/new', compact('getData'));
    }

    public function create()
    {
        try {
            $processId     = $this->request->getPost('history_patient_process_id');
            $codPaciente   = $this->request->getPost('cod_paciente');
            $fechaRegister = $this->request->getPost('fecha');
            $files         = $this->request->getFiles();

            $data = [
                'history_patient_process_id'    => $processId,
                'fecha_register'                => $fechaRegister,
                'evaluacion'                    => $this->request->getPost('evaluacion_tecnica') ?? null,
                'diagnostico'                   => $this->request->getPost('diagnostico_tecnico') ?? null,
                'pruebas_encaje'                => $this->request->getPost('prueba_ajuste_observacion') ?? null,
                'observaciones'                 => $this->request->getPost('observacion_adicional') ?? null,
                'tecnico'                       => $this->request->getPost('tecnico') ?? 'sistema',
            ];

            $this->db->transStart();

            $registerProcessId = $this->registerProcessModel->insert($data, true);

            if (!$registerProcessId) {
                $dbError = $this->db->getLastQuery();
                $errorInfo = $this->db->error();
                throw new \RuntimeException(
                    'No se pudo insertar el registro principal. ' .
                        'Query: ' . $dbError .
                        ' Error DB: ' . json_encode($errorInfo)
                );
            }

            $subdir     = "{$codPaciente}/{$processId}/{$registerProcessId}/{$fechaRegister}/";
            $uploadPath = FCPATH . 'uploads/history/' . $subdir;

            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0755, true)) {
                    throw new \RuntimeException('No se pudo crear el directorio de subida: ' . $uploadPath);
                }
            }

            if (!empty($files['file'])) {
                foreach ($files['file'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();

                        if (!$file->move($uploadPath, $newName)) {
                            throw new \RuntimeException('No se pudo mover el archivo: ' . $file->getName());
                        }

                        $imgData = [
                            'history_register_process_id' => $registerProcessId,
                            'ruta_imagen'                 => 'uploads/history/' . $subdir . $newName,
                            'created_at'                  => date('Y-m-d H:i:s'),
                        ];

                        $insertResult = $this->registerImageModel->insert($imgData);
                        if (!$insertResult) {
                            $dbError = $this->db->getLastQuery();
                            $errorInfo = $this->db->error();
                            throw new \RuntimeException(
                                'No se pudo guardar la información de la imagen. ' .
                                    'Query: ' . $dbError .
                                    ' Error DB: ' . json_encode($errorInfo)
                            );
                        }
                    }
                }
            }

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                $dbError = $this->db->getLastQuery();
                $errorInfo = $this->db->error();
                throw new \RuntimeException(
                    'Error en la transacción de base de datos. ' .
                        'Query: ' . $dbError .
                        ' Error DB: ' . json_encode($errorInfo)
                );
            }

            return $this->response
                ->setStatusCode(201)
                ->setJSON([
                    'status'  => 201,
                    'message' => 'Registro guardado correctamente'
                ]);
        } catch (\Exception $e) {
            // Hacer rollback de la transacción si está activa
            if ($this->db->transStatus() !== false) {
                $this->db->transRollback();
            }

            // Log del error para debugging
            log_message('error', 'Error en create(): ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());

            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al procesar la solicitud: ' . $e->getMessage(),
                    'error'   => $e->getMessage()
                ]);
        }
    }

    public function completarProceso(int $id)
    {
        try {

            $actual = $this->historyPatientProcessModel->find($id);
            if (!$actual) {
                throw new \Exception('Proceso no encontrado');
            }

            $this->db->transStart();

            $this->historyPatientProcessModel->update($id, [
                'status' => 'completado',
                'proceso_actual' => 0
            ]);

            $pasoServ = $this->historyProcessServiceModel->find($actual['process_id']);
            $siguiente = $this->historyProcessServiceModel
                ->where('service_id', $pasoServ['service_id'])
                ->where('order >', $pasoServ['order'])
                ->orderBy('order', 'ASC')
                ->first();

            if ($siguiente) {
                $this->historyPatientProcessModel->insert([
                    'contract_id' => $actual['contract_id'],
                    'process_id' => $siguiente['id'],
                    'proceso_actual' => 1,
                    'status' => 'en_proceso'
                ]);
            } else {
                $this->historyPatientProcessModel->update($id, [
                    'status' => 'completado',
                    'proceso_actual' => 0
                ]);
            }

            $this->db->transComplete();

            if (! $this->db->transStatus()) {
                throw new \Exception('Error al completar la transacción');
            }

            return $this->response
                ->setStatusCode(201)
                ->setJSON([
                    'status'  => 201,
                    'message' => 'Proceso completado y siguiente paso insertado'
                ]);
        } catch (\Exception $e) {
            if ($this->db->transStatus()) {
                $this->db->transRollback();
            }
            log_message('error', 'Error en completarProceso: ' . $e->getMessage());
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'No se pudo completar el proceso: ' . $e->getMessage()
                ]);
        }
    }

    public function verRegistroDebug(int $id)
    {
        try {
            // 1. Find the register
            $reg = $this->registerProcessModel->find($id);
            log_message('debug', 'Register found: ' . json_encode($reg));

            if (!$reg) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON(['error' => 'Registro no encontrado']);
            }

            // 2. Find the history patient process
            $pp = $this->historyPatientProcessModel->find($reg['history_patient_process_id']);
            log_message('debug', 'Patient process found: ' . json_encode($pp));

            if (!$pp) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON(['error' => 'Proceso de paciente no encontrado']);
            }

            // 3. Debug the query for patient information
            $query = $this->historyPatientProcessModel
                ->select([
                    'history_patient_process.id as hpp_id',
                    'history_patient_process.contract_id',
                    'c.paciente_id',
                    'CONCAT(p.nombres, " ", p.apellidos) AS paciente',
                    'p.cod_paciente',
                ])
                ->join('contratos c', 'c.id = history_patient_process.contract_id', 'left')
                ->join('pacientes p', 'p.id = c.paciente_id', 'left')
                ->where('history_patient_process.id', $pp['id']);

            // log_message('debug', 'Patient query SQL: ' . $query->getCompiledSelect());

            $pac = $query->first();
            log_message('debug', 'Patient data found: ' . json_encode($pac));

            if (!$pac) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON(['error' => 'Información del paciente no encontrada']);
            }

            // 4. Get process service information
            $ps = $this->historyProcessServiceModel->find($pp['process_id']);
            log_message('debug', 'Process service found: ' . json_encode($ps));

            if (!$ps) {
                return $this->response
                    ->setStatusCode(404)
                    ->setJSON(['error' => 'Información del proceso no encontrada']);
            }

            // 5. Get images
            $images = $this->registerImageModel
                ->where('history_register_process_id', $id)
                ->findAll();

            return $this->response->setJSON([
                'status'        => 200,
                'paciente'      => mb_strtoupper($pac['paciente'] ?? ''),
                'cod_paciente'  => $pac['cod_paciente'] ?? '',
                'fecha'         => fecha_spanish($reg['fecha_register']),
                'proceso'       => $ps['nombre'] ?? '',
                'evaluacion'    => $reg['evaluacion'] ?? '',
                'diagnostico'   => $reg['diagnostico'] ?? '',
                'pruebas'       => $reg['pruebas_encaje'] ?? '',
                'tecnico'       => $reg['tecnico'] ?? '',
                'observaciones' => $reg['observaciones'] ?? '',
                'imagenes'      => $images ?? []
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error verRegistro(): ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->response
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON([
                    'status'  => 500,
                    'message' => 'Error al obtener la entrada: ' . $e->getMessage(),
                ]);
        }
    }

    public function generatePdfOneHistory(int $id = null)
    {
        $paciente = [
            'nombre' => 'ALEJANDRO DE LA CRUZ MALDONADO',
            'tipo_protesis' => 'Mano Parcial Estética',
            'diagnostico' => 'ACCIDENTE CON EXPLOSIVO',
            'fecha' => date('d/m/Y'),
            'hora' => date('h:i A'),
            'sede' => 'Lima',
            'observaciones' => [
                'SE TOMÓ MOLDES CON SILIKA Y ALGINATO',
                'FOTOGRAFÍA',
                'MEDIDAS',
                'PRUEBAS DE COLOR'
            ],
            'tecnico' => 'Dr. Juan Pérez',
            'numero_historia' => 'HT-' . date('Ymd') . '-001'
        ];

        // Configuración de mPDF
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 20,
            'margin_bottom' => 20,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        // Establecer propiedades del documento
        $mpdf->SetTitle('Historial Técnico - ' . $paciente['nombre']);
        $mpdf->SetAuthor('Sistema Médico');
        $mpdf->SetSubject('Historial Técnico Protésico');

        // Header personalizado
        $header = $this->generarHeader($paciente);
        $mpdf->SetHTMLHeader($header);

        // Footer personalizado
        $footer = $this->generarFooter();
        $mpdf->SetHTMLFooter($footer);

        // Contenido principal
        $html = $this->generarContenidoHTML($paciente);

        $mpdf->WriteHTML($html);

        // Generar el PDF
        $filename = 'historial_tecnico_' . $paciente['numero_historia'] . '.pdf';

        // Opción 1: Descargar directamente
        $mpdf->Output($filename, 'I');

        // Opción 2: Mostrar en navegador (comentar la línea anterior)
        // $mpdf->Output($filename, 'I');

        // Opción 3: Guardar en servidor (comentar línea de Output anterior)
        // $mpdf->Output(WRITEPATH . 'uploads/historiales/' . $filename, 'F');

        exit;
    }

    private function generarHeader($paciente)
    {
        return '
        <div style="border-bottom: 2px solid #2c5282; padding-bottom: 10px; margin-bottom: 30px;">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td width="20%" style="text-align: center;">
                        <img src="' . base_url('assets/images/logo.png') . '" alt="Logo" style="height: 60px;">
                    </td>
                    <td width="60%" style="text-align: center;">
                        <h1 style="color: #2c5282; margin: 0; font-size: 24px; font-weight: bold;">
                            CENTRO PROTÉSICO MÉDICO
                        </h1>
                        <p style="margin: 5px 0; color: #666; font-size: 14px;">
                            Historial Técnico Especializado
                        </p>
                    </td>
                    <td width="20%" style="text-align: right; font-size: 12px; color: #666;">
                        <strong>N° Historia:</strong><br>
                        ' . $paciente['numero_historia'] . '<br>
                        <strong>Fecha:</strong><br>
                        ' . $paciente['fecha'] . '
                    </td>
                </tr>
            </table>
        </div>';
    }

    private function generarFooter()
    {
        return '
        <div style="border-top: 1px solid #ddd; padding-top: 10px; font-size: 10px; color: #666;">
            <table width="100%">
                <tr>
                    <td width="33%">
                        <strong>Centro Protésico Médico</strong><br>
                        Lima, Perú
                    </td>
                    <td width="34%" style="text-align: center;">
                        Página {PAGENO} de {nbpg}
                    </td>
                    <td width="33%" style="text-align: right;">
                        Generado el: ' . date('d/m/Y H:i') . '
                    </td>
                </tr>
            </table>
        </div>';
    }

    private function generarContenidoHTML($paciente)
    {
        $observacionesHTML = '';
        foreach ($paciente['observaciones'] as $obs) {
            $observacionesHTML .= '<li style="margin-bottom: 8px; line-height: 1.4;">' . $obs . '</li>';
        }

        return '
        <style>
            body { 
                font-family: "Helvetica", Arial, sans-serif; 
                font-size: 12px; 
                line-height: 1.6; 
                color: #333;
            }
            .section-title { 
                background-color: #2c5282; 
                color: white; 
                padding: 8px 12px; 
                margin: 20px 0 10px 0; 
                font-weight: bold; 
                font-size: 14px;
                border-radius: 3px;
                margin-top: 15px;
            }
            .info-table { 
                width: 100%; 
                border-collapse: collapse; 
                margin-bottom: 15px;
                background-color: #f8f9fa;
            }
            .info-table td { 
                padding: 12px; 
                border: 1px solid #dee2e6; 
                vertical-align: top;
            }
            .info-table .label { 
                background-color: #e9ecef; 
                font-weight: bold; 
                width: 30%;
                color: #495057;
            }
            .diagnostic-box {
                background-color: #fff3cd;
                border: 2px solid #ffeaa7;
                border-left: 5px solid #f39c12;
                padding: 15px;
                margin: 15px 0;
                border-radius: 5px;
            }
            .observations-box {
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                border-left: 4px solid #28a745;
                padding: 15px;
                margin: 15px 0;
            }
            .signature-section {
                margin-top: 50px;
                border-top: 2px solid #dee2e6;
                padding-top: 30px;
            }
            .signature-box {
                text-align: center;
                border: 1px solid #dee2e6;
                padding: 40px 20px 20px 20px;
                margin: 0 20px;
                background-color: #f8f9fa;
            }
        </style>

        <div class="section-title">INFORMACIÓN DEL PACIENTE</div>
        <table class="info-table">
            <tr>
                <td class="label">Nombre Completo:</td>
                <td><strong style="font-size: 14px;">' . $paciente['nombre'] . '</strong></td>
            </tr>
            <tr>
                <td class="label">Tipo de Prótesis:</td>
                <td>' . $paciente['tipo_protesis'] . '</td>
            </tr>
            <tr>
                <td class="label">Fecha de Evaluación:</td>
                <td>' . $paciente['fecha'] . '</td>
            </tr>
            <tr>
                <td class="label">Hora:</td>
                <td>' . $paciente['hora'] . '</td>
            </tr>
            <tr>
                <td class="label">Sede:</td>
                <td>' . $paciente['sede'] . '</td>
            </tr>
        </table>

        <div class="section-title">DIAGNÓSTICO TÉCNICO</div>
        <div class="diagnostic-box">
            <h3 style="margin: 0 0 10px 0; color: #e67e22; font-size: 16px;">
                ⚠️ ' . $paciente['diagnostico'] . '
            </h3>
            <p style="margin: 0; font-style: italic; color: #666;">
                Evaluación realizada por personal técnico especializado
            </p>
        </div>

        <div class="section-title">EVALUACIÓN Y PROCEDIMIENTOS</div>
        <div class="observations-box">
            <h4 style="margin: 0 0 15px 0; color: #28a745;">Procedimientos Realizados:</h4>
            <ul style="margin: 0; padding-left: 20px;">
                ' . $observacionesHTML . '
            </ul>
        </div>

        <div class="section-title">PRUEBAS Y AJUSTES</div>
        <table class="info-table">
            <tr>
                <td class="label">Estado de Moldes:</td>
                <td>✅ Completado con Silika y Alginato</td>
            </tr>
            <tr>
                <td class="label">Documentación Fotográfica:</td>
                <td>✅ Realizada</td>
            </tr>
            <tr>
                <td class="label">Medidas Antropométricas:</td>
                <td>✅ Tomadas y Verificadas</td>
            </tr>
            <tr>
                <td class="label">Pruebas de Color:</td>
                <td>✅ Realizadas para Compatibilidad</td>
            </tr>
        </table>

        <div class="signature-section">
            <table width="100%">
                <tr>
                    <td width="45%">
                        <div class="signature-box">
                            <div style="height: 60px; margin-bottom: 10px;"></div>
                            <div style="border-top: 2px solid #333; padding-top: 5px;">
                                <strong>' . $paciente['tecnico'] . '</strong><br>
                                <small>TÉCNICO ENCARGADO</small><br>
                                <small>Registro Profesional: TP-2024-001</small>
                            </div>
                        </div>
                    </td>
                    <td width="10%"></td>
                    <td width="45%">
                        <div class="signature-box">
                            <div style="height: 60px; margin-bottom: 10px;"></div>
                            <div style="border-top: 2px solid #333; padding-top: 5px;">
                                <strong>' . $paciente['nombre'] . '</strong><br>
                                <small>PACIENTE</small><br>
                                <small>DNI: ________________</small>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 30px; padding: 15px; background-color: #f1f3f4; border-radius: 5px; font-size: 11px;">
            <strong>Nota Importante:</strong> Este documento constituye un registro oficial del proceso técnico 
            realizado. Conservar para futuras referencias y seguimiento del tratamiento protésico.
        </div>
        ';
    }
}
