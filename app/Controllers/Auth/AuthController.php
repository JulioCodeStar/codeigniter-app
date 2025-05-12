<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\SedeModel;
use App\Models\Users;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

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
      $jwt = $this->generateJWT($user);
      $this->setSession($user);

      if ($this->request->is('ajax')) {
        return $this->respond([
          'token' => $jwt,
          'redirect' => base_url('/')
        ]);
      }
      return redirect()->to(base_url('/'));
    }

    return redirect()->back()->withInput()->with('errors', 'Usuario o contraseña incorrectos');
  }

  private function generateJWT($user)
  {
    $key = getenv('JWT_SECRET_KEY');
    $payload = [
      'iss' => base_url(),
      'aud' => base_url(),
      'iat' => time(),
      'exp' => time() + 172800, // 2 días (60*60*24*2)
      'data' => [
        'user_id' => $user['id'],
        'email' => $user['email'],
        //'roles' => $user['roles'], // Asumiendo que tu modelo devuelve los roles
        //'permisos' => $user['permisos'] // Asumiendo que tu modelo devuelve los permisos
      ]
    ];

    return JWT::encode($payload, $key, 'HS256');
  }

  private function setSession($user)
  {
    $data = [
      'logged_in' => true,
      'user_id' => $user['id'],
      'nombres' => $user['nombres'],
      'apellidos' => $user['apellidos'],
      'email' => $user['email'],
      'active' => $user['is_active'],
    ];

    $this->session->set($data);
  }

  public function logout()
  {
    if ($this->session->get('logged_in')) {
      $this->session->destroy();
    }

    // Para JWT: Invalida el token si usas lista de tokens
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

