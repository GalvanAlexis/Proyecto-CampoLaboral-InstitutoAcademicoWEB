<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//RUTAS PARA EL CRUD DE TURNOS
$routes->get('/turnos', 'Turnos::index');
$routes->get('/turnos/create', 'Turnos::create');
$routes->post('/turnos/store', 'Turnos::store');
$routes->get('/turnos/edit/(:num)', 'Turnos::edit/$1');
$routes->post('/turnos/update/(:num)', 'Turnos::update/$1');
$routes->get('/turnos/delete/(:num)', 'Turnos::delete/$1');

// Rutas para el CRUD de Alumnos
$routes->get('alumnos', 'Alumno::index');
$routes->get('alumnos/new', 'Alumno::new');
$routes->post('alumnos/create', 'Alumno::create');
$routes->get('alumnos/edit/(:num)', 'Alumno::edit/$1');
$routes->post('alumnos/update/(:num)', 'Alumno::update/$1');
$routes->get('alumnos/delete/(:num)', 'Alumno::delete/$1');

// Rutas para el CRUD de Categorías
$routes->get('/categorias', 'Categorias::index');
$routes->get('categorias/create', 'Categorias::create');
$routes->post('/categorias/store', 'Categorias::store');
$routes->get('categorias/edit/(:num)', 'Categorias::edit/$1');
$routes->post('categorias/update/(:num)', 'Categorias::update/$1');
$routes->get('categorias/delete/(:num)', 'Categorias::delete/$1');