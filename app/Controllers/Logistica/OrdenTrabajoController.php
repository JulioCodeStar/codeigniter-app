<?php

namespace App\Controllers\Logistica;

use App\Controllers\BaseController;
use App\Models\Logistica\OrdenTrabajoModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrdenTrabajoController extends BaseController
{
    protected $trabajoModel;

    function __construct()
    {
        $this->trabajoModel = new OrdenTrabajoModel();
    }

    public function index()
    {
        $data['trabajos'] = $this->trabajoModel->findAll();
        return view('logistica/trabajo/index', $data);
    }

    public function new()
    {
        return view('logistica/trabajo/new');
    }

    public function create()
    {
        try {            
            $post = $this->request->getPost();

            $data = [
                'necesidad'             => $post['nivel_necesidad'] ?? null,
                'area_responsable'      => $post['area_responsable'] ?? null,
                'aprobado_por'          => $post['aprobado_por'] ?? null,
                'actividad'             => $post['actividad'] ?? null,
                'descripcion'           => $post['descripcion'] ?? null,
                'requerido_a'           => $post['requerido_a'] ?? null,
                'responsable'           => $post['responsable'] ?? null,
                'tiempo_eje'            => $post['tiempo_ejecucion'] ?? null,
            ];

            $this->trabajoModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Orden registrada correctamente',
                    ]);
            }

            return redirect()
                ->to('logistica/orden-trabajo')
                ->with('success', 'Orden registrada correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al crear orden de trabajo: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear orden de trabajo: ' . $e->getMessage(),
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->to('logistica/orden-trabajo');
        }

        $this->trabajoModel->delete($id);

        return redirect()->to('logistica/orden-trabajo');
    }

    public function generatePdf(int $id)
    {

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'font' => 'arial',
            'margin_top' => 15,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]);

        $trabajo = $this->trabajoModel->find($id);

        $view = 'pdf/logistica/trabajo/index';

        $data = [
            'codigo'    => $trabajo['codigo'],
            'fecha'     => fecha_spanish($trabajo['created_at']),
            'logo'      => base_url('assets/media/img/encabezado.png'),
            'trabajo'    => $trabajo,
        ];
        $html = view($view, $data);

        $header = '
        <div style="width: 100%; padding: 0 20px; border-bottom: 2px solid #216E71; margin-bottom: 20px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 70%; text-align: left; vertical-align: bottom;">
                        <div style="font-size: 20pt; font-weight: bold;">Orden de Trabajo</div>
                        <div style="margin-top: 5px;">
                            <span>N°: '. $data['codigo'] .'</span>
                            <div style="margin-top: 3px;">Fecha: ' . $data['fecha'] . '</div>
                        </div>
                    </td>
                    <td style="width: 30%; text-align: right; vertical-align: bottom;">
                        <img src="' . $data['logo'] . '" style="height: 50px;">
                    </td>
                </tr>
            </table>
        </div>
        ';

        $mpdf->SetHTMLHeader($header);

        $mpdf->WriteHTML($html);
        $mpdf->Output('Orden_de_Trabajo.pdf', 'I');

        exit;
    }
}
