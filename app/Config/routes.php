<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/turnos', 'Turnos::index');
$routes->get('/turnos/create', 'Turnos::create');
$routes->post('/turnos/store', 'Turnos::store');
$routes->get('/turnos/edit/(:num)', 'Turnos::edit/$1');
$routes->post('/turnos/update/(:num)', 'Turnos::update/$1');
$routes->get('/turnos/delete/(:num)', 'Turnos::delete/$1');
