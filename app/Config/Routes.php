<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth/login', 'Auth\AuthController::index', ['filter' => 'alreadyLogged']);
$routes->get('sales/auth/login', 'Auth\AuthController::sales', ['filter' => 'alreadyLoggedSales']);


/* ROUTES PRIVATES */
$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('/', 'Home::index');

  /* Gestión de Pacientes */
  $routes->group('patient', '', function ($routes) {
    $routes->get('/', 'Patient\PatientController::index');
    $routes->get('new', 'Patient\PatientController::new');
    $routes->get('show/(:segment)', 'Patient\PatientController::show/$1');
    $routes->get('generate/(:segment)', 'Patient\PatientController::generarPDF/$1');
    // $routes->post('store', 'Patient\PatientController::store');
    // $routes->post('update/(:num)', 'Patient\PatientController::update/$1');
    // $routes->get('delete/(:num)', 'Patient\PatientController::delete/$1'); 
  });

  /* Cotizaciones */
  $routes->group('invoice', '', function ($routes) {
    $routes->get('', 'Patient\InvoiceController::index');
    $routes->get('new', 'Patient\InvoiceController::new');
    $routes->get('show/(:num)', 'Patient\InvoiceController::show/$1');
    $routes->get('generate/(:num)', 'Patient\InvoiceController::generateCotiPDF/$1');
  });
});



/* APIs */
$routes->group('api', function ($routes) {
  $routes->group('auth', function ($routes) {
    $routes->post('login', 'Auth\AuthController::login');
    // $routes->post('register', 'Auth\AuthController::register');
    $routes->get('logout', 'Auth\AuthController::logout');
  });

  /* Gestión de Pacientes */
  $routes->group('patient', function ($routes) {
    $routes->post('create', 'Patient\PatientController::create');
    $routes->post('edit/(:segment)', 'Patient\PatientController::edit/$1');
    $routes->post('delete/(:segment)', 'Patient\PatientController::delete/$1');
  });

  /* Cotizaciones */
  $routes->group('invoice', function ($routes) {
    $routes->get('getServiceJob/(:num)', 'Patient\InvoiceController::getServiceJob/$1');
    $routes->get('components/(:num)', 'Patient\InvoiceController::getcomponentsIfJob/$1');

    $routes->post('create', 'Patient\InvoiceController::create');
    $routes->post('edit/(:num)', 'Patient\InvoiceController::edit/$1');
    $routes->post('delete/(:num)', 'Patient\InvoiceController::delete/$1');
  });

  /* Caja Ventas */
  $routes->group('sales', function ($routes) {
    $routes->post('login', 'CajaVentas\Auth\AuthController::login');
    $routes->get('logout', 'CajaVentas\Auth\AuthController::logout');
    $routes->post('init-sales', 'CajaVentas\Sales\SalesController::OpenSales');
    
    $routes->get('list-component/(:segment)', 'CajaVentas\Sales\ContractController::getListInvoice/$1');
    $routes->get('get-list/(:num)', 'CajaVentas\Sales\ContractController::getDataInvoiceByID/$1');
    $routes->post('contract/create', 'CajaVentas\Sales\ContractController::create');
  });
});



/*---- CAJA VENTAS ----*/
$routes->group('sales', ['filter' => 'authsales'], function ($routes) {
  $routes->get('/', 'CajaVentas\Sales\SalesController::index');

  /* CONTRATOS */
  $routes->get('contract', 'CajaVentas\Sales\ContractController::index');
  $routes->get('contract/new', 'CajaVentas\Sales\ContractController::new');

  $routes->get('contract/pagos', 'CajaVentas\Sales\ContractController::pagos');
  
});
