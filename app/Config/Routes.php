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

  /* Gestión de Usuarios */
  $routes->group('users', '', function ($routes) {
    $routes->get('', 'Auth\UserController::index');
    $routes->get('roles', 'Auth\UserController::roles');
    $routes->get('permisos', 'Auth\UserController::permisos');
  });

  /* Gestión de Pacientes */
  $routes->group('patient', '', function ($routes) {
    $routes->get('/', 'Patient\PatientController::index');
    $routes->get('new', 'Patient\PatientController::new');
    $routes->get('show/(:segment)', 'Patient\PatientController::show/$1');
    $routes->get('generate/(:segment)', 'Patient\PatientController::generarPDF/$1');
    $routes->get('generate_evaluacion/(:segment)/(:segment)', 'Patient\PatientController::ficha_evaluacion/$1/$2');
  });

  /* Cotizaciones */
  $routes->group('invoice', '', function ($routes) {
    $routes->get('', 'Patient\InvoiceController::index');
    $routes->get('new', 'Patient\InvoiceController::new');
    $routes->get('show/(:num)', 'Patient\InvoiceController::show/$1');
    $routes->get('generate/(:num)', 'Patient\InvoiceController::generateCotiPDF/$1');
  });

  $routes->group('contract', '', function ($routes) {
    $routes->get('', 'Patient\ContractController::index');
    $routes->get('pagos/(:num)', 'Patient\ContractController::pagos/$1');
  });

  $routes->group('accesorios', '', function ($routes) {
    $routes->get('', 'Patient\AccesoriosController::index');
    $routes->get('pagos/(:num)', 'Patient\AccesoriosController::pagos/$1');
  });

  $routes->group('citas', '', function ($routes) {
    $routes->get('', 'Patient\CitasController::index');
  });

  $routes->group('managment', '', function ($routes) {
    $routes->get('',  'Patient\ManagmentController::index');
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
    $routes->post('close-sales', 'CajaVentas\Sales\SalesController::CloseSales');

    $routes->get('list-component/(:segment)', 'CajaVentas\Sales\ContractController::getListInvoice/$1');
    $routes->get('get-list/(:num)', 'CajaVentas\Sales\ContractController::getDataInvoiceByID/$1');

    /* CONTRATOS */
    $routes->group('contract', function ($routes) {
      $routes->post('create', 'CajaVentas\Sales\ContractController::create');
      $routes->get('getDataContract/(:num)', 'CajaVentas\Sales\ContractController::getContractById/$1');
      $routes->post('pagos/delete/(:num)', 'CajaVentas\Sales\ContractController::delete_pagos/$1');
      $routes->post('delete/(:num)', 'CajaVentas\Sales\ContractController::delete_contrato/$1');

      $routes->post('pagos/create', 'CajaVentas\Sales\ContractController::create_pagos');
    });

    /* VENTAS ACCESORIOS */
    $routes->group('accesorios', function ($routes) {
      $routes->post('create', 'CajaVentas\Sales\AccesoriosController::create');
      $routes->get('getDataAccesorios/(:num)', 'CajaVentas\Sales\AccesoriosController::getVentasById/$1');
      $routes->post('create_pago', 'CajaVentas\Sales\AccesoriosController::create_pagos');
      $routes->post('pagos/delete/(:num)', 'CajaVentas\Sales\AccesoriosController::delete_pagos/$1');
      $routes->post('ventas/delete/(:num)', 'CajaVentas\Sales\AccesoriosController::delete_contrato/$1');
    });

    /* CITAS */
    $routes->group('citas', function ($routes) {
      $routes->post('create', 'CajaVentas\Sales\CitasController::create');
      $routes->post('delete/(:num)', 'CajaVentas\Sales\CitasController::delete_pagos/$1');
    });

    /* MANTENIMIENTO */
    $routes->group('managment', function ($routes) {
      $routes->post('create', 'CajaVentas\Sales\ManagmentController::create');
      $routes->post('delete/(:num)', 'CajaVentas\Sales\ManagmentController::delete_pagos/$1');
    });

    /* SEGUIMIENTO */
    $routes->group('seguimiento', function ($routes) {
      $routes->post('get-data', 'CajaVentas\Sales\SeguimientoController::getDataByDateAndSede');
    });

    /* REPORTS */
    $routes->group('reports', function ($routes) {
      $routes->post('get-beetween', 'CajaVentas\Sales\ReportsController::getDataByDateBeetweenAndSede');
      $routes->get('generate', 'CajaVentas\Sales\ReportsController::generateReport');
    });
  });

  $routes->get('csrf/refresh-token', 'CsrfController::refreshToken');
});



/*---- CAJA VENTAS ----*/
$routes->group('sales', ['filter' => 'authsales'], function ($routes) {
  $routes->get('/', 'CajaVentas\Sales\SalesController::index');

  /* CONTRATOS */
  $routes->get('contract', 'CajaVentas\Sales\ContractController::index');
  $routes->get('contract/new', 'CajaVentas\Sales\ContractController::new');

  $routes->get('contract/pagos', 'CajaVentas\Sales\ContractController::pagos');
  $routes->get('contract/generate/(:num)', 'CajaVentas\Sales\ContractController::generatePdfContract/$1');
  $routes->get('contract/generate/pagos/(:num)/(:num)', 'CajaVentas\Sales\ContractController::generatePdfPagosContract/$1/$2');

  /* VENTA ACCESORIOS */
  $routes->get('accesorios', 'CajaVentas\Sales\AccesoriosController::index');
  $routes->get('accesorios/new', 'CajaVentas\Sales\AccesoriosController::new');
  $routes->get('accesorios/pagos', 'CajaVentas\Sales\AccesoriosController::pagos');
  $routes->get('accesorios/generate/(:num)', 'CajaVentas\Sales\AccesoriosController::generatePdfAccesorios/$1');
  $routes->get('accesorios/generate/pagos/(:num)/(:num)', 'CajaVentas\Sales\AccesoriosController::generatePdfPagosAccesorios/$1/$2');

  /* CITAS */
  $routes->group('citas', function ($routes) {
    $routes->get('/', 'CajaVentas\Sales\CitasController::index');
    $routes->get('generate/(:num)', 'CajaVentas\Sales\CitasController::generatePdfReciboCita/$1');
  });


  /* MANTENIMIENTO */
  $routes->group('managment', function ($routes) {
    $routes->get('/', 'CajaVentas\Sales\ManagmentController::index');
    $routes->get('generate/(:num)', 'CajaVentas\Sales\ManagmentController::generatePdfReciboManagment/$1');
  });

  /* SEGUIMIENTO */
  $routes->group('seguimiento', function ($routes) {
    $routes->get('', 'CajaVentas\Sales\SeguimientoController::index');
  });

  /* REPORTES */
  $routes->group('reports', function ($routes) {
    $routes->get('/', 'CajaVentas\Sales\ReportsController::index');
  });
});
