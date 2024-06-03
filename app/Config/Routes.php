<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('UserModel', 'UserController::index');

$routes->post('UserModel', 'UserController::create');

$routes->put('UserModel/(:num)', 'UserController::update/$1');

$routes->delete('UserModel/(:num)', 'UserController::delete/$1');