<?php

/** @var \Laravel\Lumen\Routing\Router $router */



$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/libros', 'LibroController@index');
$router->post('/libros', 'LibroController@guardar');
$router->get('/libros/{id}', 'LibroController@ver');    
$router->delete('/libros/{id}', 'LibroController@eliminar');
$router->post('/libros/{id}', 'LibroController@actualizar');