<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use App\Models\CajaVentas\PagosModel;
use CodeIgniter\API\ResponseTrait;

class CitasController extends BaseController
{
  use ResponseTrait;
  protected $citasModel;

  function __construct()
  {
    $this->citasModel = new PagosModel();
  }

  public function index() 
  {
    $data['citas'] = $this->citasModel->getAllCitas();
    return view('patients/citas/index', $data);  
  }

}