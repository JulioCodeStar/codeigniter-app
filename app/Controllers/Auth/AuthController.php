<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\SedeModel;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;

class AuthController extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    return view('auth/login');
  }

  public function login()
  {
    $rules = [
      'email' => 'required|valid_email',
      'password' => 'required|min_length[8]',
    ];

    if (!$this->validate($rules)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
    }

    $userModel = new Users();
    $post = $this->request->getPost(['email', 'password']);

    $user = $userModel->validateUser($post['email'], $post['password']);

    if ($user !== null) {
      $this->setSession($user);

      if ($this->request->is('ajax')) {
        return $this->respond([
          'redirect' => base_url('/')
        ]);
      }
      return redirect()->to(base_url('/'));
    }

    return redirect()->back()->withInput()->with('errors', 'Usuario o contraseña incorrectos');
  }

  private function setSession($user)
  {
    $data = [
      'user_id' => $user['id'],
      'nombres' => $user['nombres'],
      'apellidos' => $user['apellidos'],
      'email' => $user['email'],
      'active' => $user['is_active'],
    ];

    $this->session->set('user', $data);
  }

  public function logout()
  {
    if ($this->session->get('user')) {
      $this->session->remove('user');
    }

    return redirect()->to(base_url('/auth/login'));
  }


  /* CAJA VENTAS */
  public function sales() 
  {
    $sedeModel = new SedeModel();

    $data['sede'] = $sedeModel->findAll();
    return view('sales/auth/login/index', $data);  
  }
}

