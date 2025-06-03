<?php

namespace App\Controllers;

class CsrfController extends BaseController
{ 
  public function refreshToken() 
  {
    return $this->response->setJSON([
      'csrf_token' => csrf_hash()
    ]);  
  }
}