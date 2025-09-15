<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rutas para el CRUD de Alumnos
$routes->get('alumnos', 'Alumno::index');
$routes->get('alumnos/new', 'Alumno::new');
$routes->post('alumnos/create', 'Alumno::create');
$routes->get('alumnos/edit/(:num)', 'Alumno::edit/$1');
$routes->post('alumnos/update/(:num)', 'Alumno::update/$1');
$routes->get('alumnos/delete/(:num)', 'Alumno::delete/$1');