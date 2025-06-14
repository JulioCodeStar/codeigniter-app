<?php

namespace App\Controllers\Logistica;

use App\Controllers\BaseController;
use App\Models\Logistica\OrdenImportacionModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrdenImportacionController extends BaseController
{
    protected $ImportacionModel;

    public function __construct()
    {
        $this->ImportacionModel = new OrdenImportacionModel();
    }

    public function index()
    {
        $data['importaciones'] = $this->ImportacionModel->findAll();
        return view('logistica/importacion/index', $data);
    }

    public function new()
    {
        return view('logistica/importacion/new');
    }

    public function create()
    {
        try {

            $post = $this->request->getPost();

            $items = json_decode($post['lista'], true);

            if (!$items || !is_array($items)) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'mensaje' => 'No se pudo procesar la lista de productos.'
                ]);
            }

            $subtotal = 0;
            foreach ($items as &$item) {
                $subtotal += $item['producto']['total'];
            }
            unset($item);

            $data = [
                'area'          => $post['area'],
                'items'         => json_encode($items),
                'moneda'        => $post['moneda'],
                'total'         => $subtotal,
                'observaciones' => $post['observaciones'] ?? null,
            ];

            $this->ImportacionModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Orden de importacion registrada correctamente',
                    ]);
            }

            return redirect()
                ->to('logistica/orden-importacion')
                ->with('success', 'Orden de importacion registrada correctamente');

        } catch (\Exception $e) {
            log_message('error', 'Error al crear orden de importacion: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear orden de importacion: ' . $e->getMessage(),
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar orden de importacion: ' . $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->to('logistica/orden-importacion');
        }

        $this->ImportacionModel->delete($id);

        return redirect()->to('logistica/orden-importacion');
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

        $importacion = $this->ImportacionModel->find($id);

        $view = 'pdf/logistica/importancion/index';

        $data = [
            'codigo'            => $importacion['codigo'],
            'fecha'             => fecha_spanish($importacion['created_at']),
            'logo'              => base_url('assets/media/img/encabezado.png'),
            'importacion'       => $importacion,
            'items'             => json_decode($importacion['items'], true),
        ];
        $html = view($view, $data);

        $header = '
        <div style="width: 100%; padding: 0 20px; border-bottom: 2px solid #216E71; margin-bottom: 5px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 70%; text-align: left; vertical-align: bottom;">
                        <div style="font-size: 20pt; font-weight: bold;">Orden de Importación</div>
                        <div style="margin-top: 5px;">
                            <span>N°: '. $data['codigo'] .'</span>
                            <div style="margin-top: 3px;">Fecha: ' . $data['fecha'] . '</div>
                            <div style="margin-top: 3px;">Area: ' . $data['importacion']['area'] . '</div>
                        </div>
                    </td>
                    <td style="width: 30%; text-align: right; vertical-align: bottom; padding-bottom: 10px;">
                        <img src="' . $data['logo'] . '" style="height: 50px;">
                    </td>
                </tr>
            </table>
        </div>
        ';

        $mpdf->SetHTMLHeader($header);
        $mpdf->setAutoTopMargin = 'pad';

        $mpdf->WriteHTML($html);
        $mpdf->Output('Orden_de_Importacion.pdf', 'I');

        exit;
    }
}
