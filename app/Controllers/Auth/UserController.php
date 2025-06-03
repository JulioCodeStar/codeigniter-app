<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
  public function index()
  {
    return view('auth/Users/index');
  }

  public function roles()
  {
    return view('auth/roles/index');
  }

  public function permisos() 
  {
    return view('auth/permisos/index');  
  }
}
