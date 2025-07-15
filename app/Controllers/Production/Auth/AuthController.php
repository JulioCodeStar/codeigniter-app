<?php

namespace App\Controllers\Production\Auth;

use App\Controllers\BaseController;
use App\Models\Production\ProductionUserModel;
use App\Models\Users;

class AuthController extends BaseController
{
    protected $userModel, $productionUserModel;

    public function __construct()
    {
        $this->userModel = new Users();
        $this->productionUserModel = new ProductionUserModel();
    }
    public function index()
    {
        return view('production/auth/index');
    }

    public function login()
    {
        $email      = $this->request->getPost('email');
        $password   = $this->request->getPost('password');

        $user       = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Credenciales Inválidas');
        }

        $acceso     = $this->productionUserModel
            ->where('user_id', $user['id'])
            ->where('is_Active', 1)
            ->first();

        if (!$acceso) {
            return redirect()->back()->with('error', 'No tienes permiso para acceder a Producción');
        }

        session()->set('production_user', [
            'id'      => $user['id'],
            'nombre'  => $user['nombres'] . ' ' . $user['apellidos'],
            'email'   => $user['email'],
            'area'    => $acceso['area'],
        ]);

        return redirect()->to('production');
    }

    public function logout()
    {
        if ($this->session->get('production_user')) {
            $this->session->remove('production_user');
        }

        return redirect()->to(base_url('/production/auth/login'));
    }
}