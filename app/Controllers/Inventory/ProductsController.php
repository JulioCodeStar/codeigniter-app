<?php

namespace App\Controllers\Inventory;

use App\Controllers\BaseController;
use App\Models\Inventory\AreaModel;
use App\Models\Inventory\ProductsModel;
use App\Models\Inventory\UnidadesModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductsController extends BaseController
{
    protected $productsModel, $areaModel, $unidadesModel;

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->areaModel = new AreaModel();
        $this->unidadesModel = new UnidadesModel();
    }

    public function index()
    {
        $products = $this->productsModel->select('inventory_products.*, areas.nombres as area_nombre, unidades.abreviatura as unidad_nombre')->join('areas', 'areas.id = inventory_products.area_id')->join('unidades', 'unidades.id = inventory_products.unidad_id')->findAll();
        $totalProducts = $this->productsModel->countAllResults();
        $totalProductsWithSerialNumber = $this->productsModel->where('requiere_serie', 1)->countAllResults();
        $totalCategories = $this->productsModel->select('categoria')->groupBy('categoria')->countAllResults();
        return view('inventory/products/index', compact('products', 'totalProducts', 'totalProductsWithSerialNumber', 'totalCategories'));
    }

    public function new()
    {
        $areas = $this->areaModel->findAll();
        $unidades = $this->unidadesModel->findAll();
        return view('inventory/products/new', compact('areas', 'unidades'));
    }

    public function create()
    {
        try {

            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'area_id' => $this->request->getPost('area_id'),
                'unidad_id' => $this->request->getPost('unidad_id'),
                'categoria' => $this->request->getPost('categoria'),
                'stock_min' => $this->request->getPost('stock_min'),
                'stock_max' => $this->request->getPost('stock_max'),
                'requiere_serie' => !empty($this->request->getPost('requiere_serie')) ? 1 : 0,
            ];

            $this->productsModel->insert($data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Producto creado exitosamente',
                    ]);
            }

            return redirect()
                ->to(base_url('inventory/products'))
                ->with('success', 'Producto creado exitosamente');
        } catch (\Exception $e) {
            // 5. Loguear error
            log_message('error', 'Error al crear producto: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al crear producto: ' . $e->getMessage(),
                    ]);
            }

            // 6. Flujo no-AJAX con flashdata de error
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function show(int $id)
    {
        $product = $this->productsModel->select('inventory_products.*, areas.nombres as area_nombre, unidades.abreviatura as unidad_nombre')->join('areas', 'areas.id = inventory_products.area_id')->join('unidades', 'unidades.id = inventory_products.unidad_id')->find($id);
        $areas = $this->areaModel->findAll();
        $unidades = $this->unidadesModel->findAll();
        return view('inventory/products/show', compact('product', 'areas', 'unidades'));
    }

    public function edit(int $id)
    {
        try {

            $data = [
                'codigo' => $this->request->getPost('codigo'),
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'area_id' => $this->request->getPost('area_id'),
                'unidad_id' => $this->request->getPost('unidad_id'),
                'categoria' => $this->request->getPost('categoria'),
                'stock_min' => $this->request->getPost('stock_min'),
                'stock_max' => $this->request->getPost('stock_max'),
                'requiere_serie' => !empty($this->request->getPost('requiere_serie')) ? 1 : 0,
            ];

            $this->productsModel->update($id, $data);

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(201)
                    ->setJSON([
                        'status'  => 201,
                        'message' => 'Producto editado exitosamente',
                    ]);
            }

            return redirect()
                ->to(base_url('inventory/products'))
                ->with('success', 'Producto editado exitosamente');
        } catch (\Exception $e) {
            // 5. Loguear error
            log_message('error', 'Error al editar producto: ' . $e->getMessage());

            if ($this->request->isAJAX()) {
                return $this->response
                    ->setStatusCode(500)
                    ->setJSON([
                        'status'  => 500,
                        'message' => 'Error al editar producto: ' . $e->getMessage(),
                    ]);
            }

            // 6. Flujo no-AJAX con flashdata de error
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function delete(string $id)
    {
        if (!$this->request->is('post') || $id == null) {
            return redirect()->route('inventory/products');
        }

        $this->productsModel->delete($id);

        return redirect()->to('inventory/products');
    }
}
