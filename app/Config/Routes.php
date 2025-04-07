<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('auth/login', 'Auth\AuthController::index', ['filter' => 'alreadyLogged']);


/* ROUTES PRIVATES */
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index');

    $routes->group('patient', '', function ($routes) {
        $routes->get('/', 'Patient\PatientController::index');
        $routes->get('create', 'Patient\PatientController::create');
        $routes->post('store', 'Patient\PatientController::store');
        $routes->get('edit/(:num)', 'Patient\PatientController::edit/$1');
        $routes->post('update/(:num)', 'Patient\PatientController::update/$1');
        $routes->get('delete/(:num)', 'Patient\PatientController::delete/$1'); 
    });
});



/* APIs */
$routes->group('api', function ($routes) {
    $routes->group('auth', function ($routes) {
        $routes->post('login', 'Auth\AuthController::login');
        // $routes->post('register', 'Auth\AuthController::register');
        $routes->get('logout', 'Auth\AuthController::logout');
    });
});
