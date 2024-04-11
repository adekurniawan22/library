<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login_action');
$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/book', 'BookController::index');
$routes->get('/book/add', 'BookController::create');
$routes->post('/book/add', 'BookController::store');
$routes->get('/book/edit/(:any)', 'BookController::update/$1');
$routes->post('/book/edit/(:any)', 'BookController::save/$1');
$routes->get('/book/delete/(:any)', 'BookController::delete/$1');

$routes->get('/user', 'UserController::index');
$routes->get('/user/add', 'UserController::create');
$routes->post('/user/add', 'UserController::store');
$routes->get('/user/edit/(:any)', 'UserController::update/$1');
$routes->post('/user/edit/(:any)', 'UserController::save/$1');
$routes->get('/user/delete/(:any)', 'UserController::delete/$1');
