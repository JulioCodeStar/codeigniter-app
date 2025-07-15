<?php

namespace App\Controllers\Inventory\Auth;

use App\Controllers\BaseController;
use App\Models\Inventory\UserInventoryModel;
use App\Models\SedeModel;
use App\Models\Users;

class AuthController extends BaseController
{
    protected $sedeModel, $userInventoryModel, $userModel;
    function __construct()
    {
        $this->sedeModel            = new SedeModel();
        $this->userInventoryModel   = new UserInventoryModel();
        $this->userModel            = new Users();
    }

    public function index()
    {
        return view('inventory/auth/login');
    }

    public function login()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();
        if (!$user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Credenciales Inválidas');
        }

        // Obtiene todas las sedes activas para este usuario
        $sedes = $this->userInventoryModel
            ->select('inventory_user.sede_id, sedes.sucursal')
            ->join('sedes', 'sedes.id = inventory_user.sede_id')
            ->where('user_id', $user['id'])
            ->where('is_active', 1)
            ->findAll();

        if (empty($sedes)) {
            return redirect()->back()->with('error', 'No tienes acceso al Inventario');
        }

        // Arma el array base de la sesión
        $sessionData = [
            'id'      => $user['id'],
            'nombre'  => $user['nombres'] . ' ' . $user['apellidos'],
            'email'   => $user['email'],
            'sedes'   => $sedes,
            // Asegúrate de tomar la primera sede (first) como activa
            'sede_id' => $sedes[0]['sede_id'],
        ];
        session()->set('inventory_user', $sessionData);

        // Redirige directo al dashboard de inventario
        return redirect()->to('inventory');
    }


    public function logout()
    {
        if ($this->session->get('inventory_user')) {
            $this->session->remove('inventory_user');
        }

        return redirect()->to(base_url('/inventory/auth/login'));
    }
}
