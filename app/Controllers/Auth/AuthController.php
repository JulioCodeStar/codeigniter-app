<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Users;

class AuthController extends BaseController
{
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
            return redirect()->to(base_url('/'));
        }

        return redirect()->back()->withInput()->with('errors', 'Usuario o contraseña incorrectos');
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
        return redirect()->to(base_url('/auth/login'));
    }
}
