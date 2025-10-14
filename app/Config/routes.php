<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes);

$routes->group('', ['filter' => 'group:admin'], function ($routes) {
//RUTAS PARA EL CRUD DE TURNOS
$routes->get('/turnos', 'Turnos::index');
$routes->get('/turnos/create', 'Turnos::create');
$routes->post('/turnos/store', 'Turnos::store');
$routes->get('/turnos/edit/(:num)', 'Turnos::edit/$1');
$routes->post('/turnos/update/(:num)', 'Turnos::update/$1');
$routes->get('/turnos/delete/(:num)', 'Turnos::delete/$1');

// Rutas para el CRUD de Alumnos
$routes->get('/alumnos', 'Alumnos::index');
$routes->get('alumnos/create', 'Alumnos::create');
$routes->post('/alumnos/store', 'Alumnos::store');
$routes->get('alumnos/edit/(:num)', 'Alumnos::edit/$1');
$routes->post('alumnos/update/(:num)', 'Alumnos::update/$1');
$routes->get('alumnos/delete/(:num)', 'Alumnos::delete/$1');

// Rutas para el CRUD de Categorías
$routes->get('/categorias', 'Categorias::index');
$routes->get('categorias/create', 'Categorias::create');
$routes->post('/categorias/store', 'Categorias::store');
$routes->get('categorias/edit/(:num)', 'Categorias::edit/$1');
$routes->post('categorias/update/(:num)', 'Categorias::update/$1');
$routes->get('categorias/delete/(:num)', 'Categorias::delete/$1');

// Rutas para el CRUD de Carreras
$routes->get('/carreras', 'Carreras::index');
$routes->get('carreras/create', 'Carreras::create');
$routes->post('/carreras/store', 'Carreras::store');
$routes->get('carreras/edit/(:num)', 'Carreras::edit/$1');
$routes->post('carreras/update/(:num)', 'Carreras::update/$1');
$routes->get('carreras/delete/(:num)', 'Carreras::delete/$1');

// Rutas para el CRUD de Profesores
$routes->get('/profesores', 'Profesores::index');
$routes->get('profesores/create', 'Profesores::create');
$routes->post('/profesores/store', 'Profesores::store');
$routes->get('profesores/edit/(:num)', 'Profesores::edit/$1');
$routes->post('profesores/update/(:num)', 'Profesores::update/$1');
$routes->get('profesores/delete/(:num)', 'Profesores::delete/$1');

//RUTAS PARA EL CRUD DE Usuarios
$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/create', 'Usuarios::create');
$routes->post('/usuarios/store', 'Usuarios::store');
$routes->get('/usuarios/edit/(:num)', 'Usuarios::edit/$1');
$routes->post('/usuarios/update/(:num)', 'Usuarios::update/$1');
$routes->get('/usuarios/delete/(:num)', 'Usuarios::delete/$1');
});

service('auth')->routes($routes);

// Ejemplo de grupo protegido por login:
$routes->group('admin', ['filter' => 'session'], function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
});
