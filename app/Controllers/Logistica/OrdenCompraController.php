<?php

namespace App\Controllers\Logistica;

use App\Controllers\BaseController;
use App\Models\Logistica\OrdenCompraModel;
use App\Models\Logistica\ProveedorModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrdenCompraController extends BaseController
{
    protected $proveedorModel, $compraModel;

    function __construct()
    {
        $this->proveedorModel = new ProveedorModel();
        $this->compraModel = new OrdenCompraModel();
    }

    public function index()
    {
        $compras = $this->compraModel->findAll();
        return view('logistica/compra/index', compact('compras'));
    }

    public function new()
    {
        $proveedores = $this->proveedorModel->findAll();
        return view('logistica/compra/new', compact('proveedores'));
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
                $subtotal += $item['total'];
            }
            unset($item);

            $data = [
                'proveedor_id' => $post['proveedor'] ?? null,
                'area'         => $post['area'],
                'forma_pago'   => $post['forma_pago'],
                'moneda'       => $post['moneda'],
                'total'        => $subtotal,
                'items'        => json_encode($items),
            ];

            $this->compraModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Orden registrada correctamente',
                    ]);
            }

            return redirect()
                ->to('logistica/compra')
                ->with('success', 'Orden registrada correctamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al crear orden de compra: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear orden de compra: ' . $e->getMessage(),
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
            return redirect()->to('logistica/orden-compra');
        }

        $this->compraModel->delete($id);

        return redirect()->to('logistica/orden-compra');
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

        $compra = $this->compraModel->find($id);

        $view = 'pdf/logistica/compras/index';

        $data = [
            'codigo'    => $compra['codigo'],
            'fecha'     => fecha_spanish($compra['created_at']),
            'logo'      => base_url('assets/media/img/encabezado.png'),
            'compra'    => $compra,
            'items'     => json_decode($compra['items'], true),
        ];
        $html = view($view, $data);

        $header = '
        <div style="width: 100%; padding: 0 20px; border-bottom: 2px solid #216E71; margin-bottom: 20px;">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 70%; text-align: left; vertical-align: bottom;">
                        <div style="font-size: 20pt; font-weight: bold;">Orden de Compra</div>
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
        $mpdf->Output('Orden_de_Compra.pdf', 'I');

        exit;
    }
}
