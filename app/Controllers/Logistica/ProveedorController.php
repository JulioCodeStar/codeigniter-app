<?php

namespace App\Controllers\Logistica;

use App\Controllers\BaseController;
use App\Models\Logistica\ProveedorModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProveedorController extends BaseController
{
    protected $proveedorModel;

    function __construct()
    {
        $this->proveedorModel = new ProveedorModel();
    }

    public function index()
    {
        $data['proveedores'] = $this->proveedorModel->findAll();
        return view('logistica/proveedor/index', $data);
    }

    public function create()
    {
        try {

            $data = [
                'nombre' => $this->request->getPost('nombre'),
                'producto' => $this->request->getPost('producto'),
                'empresa' => $this->request->getPost('empresa'),
                'telefono' => $this->request->getPost('telefono'),
                'email' => $this->request->getPost('correo'),
            ];

            $this->proveedorModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Proveedor creado exitosamente',
                        'redirect' => 'proveedor'
                    ]);
            }

            return redirect()
                ->to('proveedor')
                ->with('success', 'Proveedor creado exitosamente');
        } catch (\Exception $e) {

            log_message('error', 'Error al crear proveedor: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear proveedor: ' . $e->getMessage(),
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar proveedor: ' . $e->getMessage());
        }
    }

    public function show(int $id)
    {
        $proveedor = $this->proveedorModel->find($id);

        if ($this->request->isAJAX()) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status'  => 200,
                    'message' => 'Proveedor encontrado',
                    'data'    => $proveedor
                ]);
        }
    }

    public function edit(int $id)
    {
        try {

            $data = [
                'nombre' => $this->request->getPost('nombre_edit'),
                'producto' => $this->request->getPost('producto_edit'),
                'empresa' => $this->request->getPost('empresa_edit'),
                'telefono' => $this->request->getPost('telefono_edit'),
                'email' => $this->request->getPost('correo_edit'),
            ];

            $this->proveedorModel->update($id, $data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Proveedor editado exitosamente',
                        'redirect' => 'proveedor'
                    ]);
            }

            return redirect()
                ->to('proveedor')
                ->with('success', 'Proveedor editado exitosamente');
        } catch (\Exception $e) {

            log_message('error', 'Error al editar proveedor: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al editar proveedor: ' . $e->getMessage(),
                    ]);
            }
        }
    }

    public function delete(int $id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->to('logistica/proveedor');
        }

        $this->proveedorModel->delete($id);

        return redirect()->to('logistica/proveedor');
    }
}
