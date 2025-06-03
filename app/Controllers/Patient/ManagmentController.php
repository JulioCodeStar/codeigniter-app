<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\CajaVentas\PagosModel;
use CodeIgniter\API\ResponseTrait;

class ManagmentController extends BaseController
{
  use ResponseTrait;
  protected $managmentModel;

  function __construct()
  {
    $this->managmentModel = new PagosModel();
  }

  public function index() 
  {
    $data['managment'] = $this->managmentModel->getAllManagment();
    return view('patients/managment/index', $data);  
  }
}