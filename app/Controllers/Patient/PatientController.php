<?php

namespace App\Controllers\Patient;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PatientController extends BaseController
{

    /* View Listado de Pacientes */
    public function index()
    {
        return view('patients/listado');
    }
}
