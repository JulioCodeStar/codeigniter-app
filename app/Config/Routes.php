<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth/login', 'Auth\AuthController::index', ['filter' => 'alreadyLogged']);
$routes->get('sales/auth/login', 'Auth\AuthController::sales', ['filter' => 'alreadyLoggedSales']);

$routes->get('unauthorized', function () {
  return view('errors/unauthorized');
});


/* ROUTES PRIVATES */
$routes->group('', ['filter' => 'auth'], function ($routes) {
  $routes->get('/', 'Home::index');

  /* Gestión de Usuarios */
  $routes->group('users', '', function ($routes) {
    $routes->get('', 'Auth\UserController::index');
    $routes->get('roles', 'Auth\UserController::roles');
    $routes->get('roles/new', 'Auth\UserController::new_roles');
    $routes->get('roles/edit/(:num)', 'Auth\UserController::edit_roles/$1');
    $routes->get('permisos', 'Auth\UserController::permisos');
  });

  /* Gestión de Pacientes */
  $routes->group('patient', '', function ($routes) {
    $routes->get('/', 'Patient\PatientController::index', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
    $routes->get('new', 'Patient\PatientController::new', ['filter' => 'permission:gestion_pacientes.pacientes.create']);
    $routes->get('show/(:segment)', 'Patient\PatientController::show/$1', ['filter' => 'permission:gestion_pacientes.pacientes.update']);
    $routes->get('generate/(:segment)', 'Patient\PatientController::generarPDF/$1', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
    $routes->get('generate_evaluacion/(:segment)/(:segment)', 'Patient\PatientController::ficha_evaluacion/$1/$2', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
  });

  /* Cotizaciones */
  $routes->group('invoice', '', function ($routes) {
    $routes->get('', 'Patient\InvoiceController::index', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
    $routes->get('new', 'Patient\InvoiceController::new', ['filter' => 'permission:gestion_pacientes.pacientes.create']);
    $routes->get('show/(:num)', 'Patient\InvoiceController::show/$1', ['filter' => 'permission:gestion_pacientes.pacientes.update']);
    $routes->get('generate/(:num)', 'Patient\InvoiceController::generateCotiPDF/$1', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
  });

  /* Contratos */
  $routes->group('contract', ['filter' => 'permission:gestion_pacientes.contratos'], function ($routes) {
    $routes->get('', 'Patient\ContractController::index');
    $routes->get('pagos/(:num)', 'Patient\ContractController::pagos/$1');
  });

  /* Accesorios */
  $routes->group('accesorios', ['filter' => 'permission:gestion_pacientes.ventas_accesorios'], function ($routes) {
    $routes->get('', 'Patient\AccesoriosController::index');
    $routes->get('pagos/(:num)', 'Patient\AccesoriosController::pagos/$1');
  });

  /* Citas */
  $routes->group('citas', ['filter' => 'permission:gestion_pacientes.citas'], function ($routes) {
    $routes->get('', 'Patient\CitasController::index');
  });

  /* Mantenimiento */
  $routes->group('managment', ['filter' => 'permission:gestion_pacientes.mantenimiento'], function ($routes) {
    $routes->get('',  'Patient\ManagmentController::index');
  });

  /* Consentimiento */
  $routes->group('consentimiento', '', function ($routes) {
    $routes->get('', 'Patient\ConsentimientoController::index');
    $routes->get('show/(:num)', 'Patient\ConsentimientoController::show/$1');
  });

  /* Logística */
  $routes->group('logistica', '', function ($routes) {

    /* Proveedores */
    $routes->group('proveedor', '', function ($routes) {
      $routes->get('', 'Logistica\ProveedorController::index');
    });

    /* Orden de Compra */
    $routes->group('orden-compra', '', function ($routes) {
      $routes->get('', 'Logistica\OrdenCompraController::index');
      $routes->get('new', 'Logistica\OrdenCompraController::new');
    });

    /* Orden de Trabajo */
    $routes->group('orden-trabajo', '', function ($routes) {
      $routes->get('', 'Logistica\OrdenTrabajoController::index');
      $routes->get('new', 'Logistica\OrdenTrabajoController::new');
    });

    /* Orden de Importacion */
    $routes->group('orden-importacion', '', function ($routes) {
      $routes->get('', 'Logistica\OrdenImportacionController::index');
      $routes->get('new', 'Logistica\OrdenImportacionController::new');
    });
  });
});



/* APIs */
$routes->group('api', function ($routes) {
  $routes->group('auth', function ($routes) {
    $routes->post('login', 'Auth\AuthController::login');
    $routes->get('logout', 'Auth\AuthController::logout');

    $routes->post('create', 'Auth\UserController::create');
    $routes->post('edit/(:segment)', 'Auth\UserController::edit/$1');
    $routes->post('delete/(:segment)', 'Auth\UserController::delete/$1');
    $routes->post('inactive/(:segment)', 'Auth\UserController::inactive/$1');
    $routes->post('active/(:segment)', 'Auth\UserController::active/$1');
    $routes->get('show/(:segment)', 'Auth\UserController::show/$1');

    /* Roles */
    $routes->group('roles', function ($routes) {
      $routes->post('store', 'Auth\UserController::store');
      $routes->post('edit/(:num)', 'Auth\UserController::update_role/$1');
    });
  });

  /* Gestión de Pacientes */
  $routes->group('patient', function ($routes) {
    $routes->post('create', 'Patient\PatientController::create', ['filter' => 'permission:gestion_pacientes.pacientes.create']);
    $routes->post('edit/(:segment)', 'Patient\PatientController::edit/$1', ['filter' => 'permission:gestion_pacientes.pacientes.update']);
    $routes->post('delete/(:segment)', 'Patient\PatientController::delete/$1', ['filter' => 'permission:gestion_pacientes.pacientes.delete']);
  });

  /* Cotizaciones */
  $routes->group('invoice', function ($routes) {
    $routes->get('getServiceJob/(:num)', 'Patient\InvoiceController::getServiceJob/$1', ['filter' => 'permission:gestion_pacientes.pacientes.listado']);
    $routes->get('components/(:num)', 'Patient\InvoiceController::getcomponentsIfJob/$1');

    $routes->post('create', 'Patient\InvoiceController::create', ['filter' => 'permission:gestion_pacientes.pacientes.create']);
    $routes->post('edit/(:num)', 'Patient\InvoiceController::edit/$1', ['filter' => 'permission:gestion_pacientes.pacientes.update']);
    $routes->post('delete/(:num)', 'Patient\InvoiceController::delete/$1', ['filter' => 'permission:gestion_pacientes.pacientes.delete']);
  });

  /* Contratos */
  $routes->group('contract', function ($routes) {
    $routes->get('generate/(:num)', 'CajaVentas\Sales\ContractController::generatePdfContract/$1');
    $routes->get('generate/pagos/(:num)/(:num)', 'CajaVentas\Sales\ContractController::generatePdfPagosContract/$1/$2');
  });

  /* Accesorios */
  $routes->group('accesorios', function ($routes) {
    $routes->get('generate/(:num)', 'CajaVentas\Sales\AccesoriosController::generatePdfAccesorios/$1');
    $routes->get('generate/pagos/(:num)/(:num)', 'CajaVentas\Sales\AccesoriosController::generatePdfPagosAccesorios/$1/$2');
  });

  /* Citas */
  $routes->group('citas', function ($routes) {
    $routes->get('generate/(:num)', 'CajaVentas\Sales\CitasController::generatePdfReciboCita/$1');
  });

  /* Mantenimiento */
  $routes->group('managment', function ($routes) {
    $routes->get('generate/(:num)', 'CajaVentas\Sales\ManagmentController::generatePdfReciboManagment/$1');
  });

  /* Carta de Consentimiento */
  $routes->group('consentimiento', function ($routes) {
    $routes->post('create', 'Patient\ConsentimientoController::create');
    $routes->post('update/(:num)', 'Patient\ConsentimientoController::update/$1');
    $routes->get('carta_provisional/(:num)', 'Patient\ConsentimientoController::carta_provisional/$1');
    $routes->get('carta_final/(:num)', 'Patient\ConsentimientoController::carta_entrega/$1');
    $routes->get('imagen/(:num)', 'Patient\ConsentimientoController::carta_imagen/$1');
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
      $routes->post('generate', 'CajaVentas\Sales\ReportsController::generateReport');
    });
  });

  /* Logística */
  $routes->group('logistica', function ($routes) {
    $routes->group('proveedor', function ($routes) {
      $routes->post('create', 'Logistica\ProveedorController::create');
      $routes->get('show/(:num)', 'Logistica\ProveedorController::show/$1');
      $routes->post('edit/(:num)', 'Logistica\ProveedorController::edit/$1');
      $routes->post('delete/(:num)', 'Logistica\ProveedorController::delete/$1');
    });

    $routes->group('orden-compra', function ($routes) {
      $routes->post('create', 'Logistica\OrdenCompraController::create');
      $routes->post('delete/(:num)', 'Logistica\OrdenCompraController::delete/$1');
      $routes->get('generate/(:num)', 'Logistica\OrdenCompraController::generatePdf/$1');
    });

    $routes->group('orden-trabajo', function ($routes) {
      $routes->post('create', 'Logistica\OrdenTrabajoController::create');
      $routes->post('delete/(:num)', 'Logistica\OrdenTrabajoController::delete/$1');
      $routes->get('generate/(:num)', 'Logistica\OrdenTrabajoController::generatePdf/$1');
    });

    $routes->group('orden-importacion', function ($routes) {
      $routes->post('create', 'Logistica\OrdenImportacionController::create');
      $routes->post('delete/(:num)', 'Logistica\OrdenImportacionController::delete/$1');
      $routes->get('generate/(:num)', 'Logistica\OrdenImportacionController::generatePdf/$1');
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
