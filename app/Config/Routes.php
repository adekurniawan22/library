<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->post('/login', 'AuthController::login_action');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('/book', 'BookController::index', ['filter' => 'auth']);
$routes->get('/book/add', 'BookController::create', ['filter' => 'auth']);
$routes->post('/book/add', 'BookController::store', ['filter' => 'auth']);
$routes->get('/book/edit/(:any)', 'BookController::update/$1', ['filter' => 'auth']);
$routes->post('/book/edit/(:any)', 'BookController::save/$1', ['filter' => 'auth']);
$routes->get('/book/delete/(:any)', 'BookController::delete/$1', ['filter' => 'auth']);

$routes->get('/user', 'UserController::index', ['filter' => 'auth']);
$routes->get('/user/add', 'UserController::create', ['filter' => 'auth']);
$routes->post('/user/add', 'UserController::store', ['filter' => 'auth']);
$routes->get('/user/edit/(:any)', 'UserController::update/$1', ['filter' => 'auth']);
$routes->post('/user/edit/(:any)', 'UserController::save/$1', ['filter' => 'auth']);
$routes->get('/user/delete/(:any)', 'UserController::delete/$1', ['filter' => 'auth']);

$routes->get('/borrowing', 'BorrowingController::index', ['filter' => 'auth']);
$routes->get('/borrowing/add', 'BorrowingController::create', ['filter' => 'auth']);
$routes->post('/borrowing/add', 'BorrowingController::store', ['filter' => 'auth']);
$routes->get('/borrowing/edit/(:any)', 'BorrowingController::update/$1', ['filter' => 'auth']);
$routes->post('/borrowing/edit/(:any)', 'BorrowingController::save/$1', ['filter' => 'auth']);
$routes->get('/borrowing/delete/(:any)', 'BorrowingController::delete/$1', ['filter' => 'auth']);

$routes->get('/history', 'HistoryController::index', ['filter' => 'auth']);
