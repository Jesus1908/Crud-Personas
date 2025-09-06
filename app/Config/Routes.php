<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Rutas: LIBROS
$routes->get('/libros', 'LibroController::index');
$routes->get('/libros/crear', 'LibroController::crear'); //Renderiza el FORM
$routes->get('/libros/editar/(:num)', 'LibroController::editar/$1');
$routes->get('/libros/buscar', 'LibroController::buscar');
$routes->post('/public/api/buscarlibro', 'LibroController::buscarLibro');

$routes->post('/libros/guardar', 'LibroController::guardar'); //<form method="POST">
$routes->post('/libros/actualizar', 'LibroController::actualizar'); //<form method="POST">

$routes->get('/libros/borrar/(:num)', 'LibroController::borrar/$1');




//Ruta: Personas
$routes->get('/personas', 'PersonaController::index');

$routes->get('/personas/crear', 'PersonaController::crear');
$routes->post('/personas/guardar', 'PersonaController::guardar');

$routes->get('/personas/editar/(:num)', 'PersonaController::editar/$1');
$routes->get('/personas/buscar', 'PersonaController::buscar');

//API
$routes->get('api/personas/buscardni/(:num)', 'PersonaController::searchByDNI/$1');
$routes->get('api/ubigeo/provincias/(:num)', 'ProvinciaController::getProvinciasByDepartamento/$1');
$routes->get('api/ubigeo/distritos/(:num)', 'DistritoController::getDistritosByProvincia/$1');

//Ruta: Recursos
$routes->get('/recursos', 'RecursoController::index');//Listar
$routes->get('/recursos/crear', 'RecursoController::crear');//Crear
$routes->post('recursos/guardar', 'RecursoController::guardar');
$routes->get('recursos/getSubcategoriasByCategoria/(:num)', 'RecursoController::getSubcategoriasByCategoria/$1');