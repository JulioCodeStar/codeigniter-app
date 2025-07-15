<?php

namespace App\Controllers\Production;

use App\Controllers\BaseController;
use App\Models\Production\ProductionsProductsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductionsProductsController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductionsProductsModel();
    }

    public function index()
    {
        $area = session('production_user')['area'];
        $products = $this->productModel->where('area', $area)->findAll();
        return view('production/products/index', compact('products'));
    }

    public function create()
    {
        try {
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'area' => $this->request->getPost('area'),
            ];

            $this->productModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Producto Registrado Exitosamente',
                        'redirect' => 'production/products'
                    ]);
            }

            return redirect()
                ->to('production/products')
                ->with('success', 'Producto Registrado Exitosamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al crear Producto: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear Producto',
                        'code' => $e->getMessage()
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = $this->productModel->find($id);
        if ($this->request->isAJAX()) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status'  => 200,
                    'message' => 'Producto encontrado',
                    'data'    => [
                        'product' => $product,
                    ]
                ]);
        }
    }

    public function edit($id)
    {
        try {
            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'area' => $this->request->getPost('area'),
            ];

            $this->productModel->update($id, $data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Producto Editado Exitosamente',
                        'redirect' => 'production/products'
                    ]);
            }

            return redirect()
                ->to('production/products')
                ->with('success', 'Producto Editado Exitosamente');
        } catch (\Exception $e) {
            log_message('error', 'Error al editar Producto: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al editar Producto',
                        'code' => $e->getMessage()
                    ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->to('production/products');
        }

        $this->productModel->delete($id);

        return redirect()->to('production/products')
            ->with('success', 'Producto Eliminado Exitosamente');
    }
}
