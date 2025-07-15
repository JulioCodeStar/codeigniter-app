<?php

namespace App\Controllers\CajaVentas\Auth;

use App\Controllers\BaseController;
use App\Models\CajaVentasModel;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
  use ResponseTrait;

  public function login()
  {
    $email      = $this->request->getPost('email');
    $password   = $this->request->getPost('password');
    $sede       = $this->request->getPost('sede');

    $userModel  = new Users();
    $user       = $userModel->where('email', $email)->first();

    if (!$user || !password_verify($password, $user['password'])) {
      return redirect()->back()->with('error', 'Credenciales Inválidas');
    }

    $cajaModel  = new CajaVentasModel();
    $acceso     = $cajaModel
      ->where('user_id', $user['id'])
      ->where('sede_id', $sede)
      ->where('is_Active', 1)
      ->first();

    if (!$acceso) {
      if ($this->request->isAJAX()) {
        return $this->response
            ->setStatusCode(401)
            ->setJSON([
                'status'  => 401,
                'message' => 'No tienes acceso a esa sede',
            ]);
      }

      return redirect()->back()->with('error', 'No tienes acceso a esa sede');
    }

    session()->set('caja_user', [
      'id'      => $user['id'],
      'nombre'  => $user['nombres'] . ' ' . $user['apellidos'],
      'email'   => $user['email'],
      'sede_id' => $sede
    ]);

    if ($this->request->isAJAX()) {
      return $this->response
          ->setStatusCode(201)
          ->setJSON([
              'status'  => 201,
              'message' => 'Sesión iniciada correctamente',
          ]);
    }

    return redirect()
                ->to('sales')
                ->with('success', 'Orden registrada correctamente');
  }

  public function logout()
  {
    if ($this->session->get('caja_user')) {
      $this->session->remove('caja_user');
    }

    return redirect()->to(base_url('/sales/auth/login'));
  }
}
