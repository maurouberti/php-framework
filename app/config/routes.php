<?php

$router->get('/teste', function() {
    dd('errro');
});

$router->get('/usuario', '\App\Controllers\UsuariosController::index');
$router->get('/usuario/{id:(\d+)}', '\App\Controllers\UsuariosController::show');
$router->post('/usuario', '\App\Controllers\UsuariosController::create');
$router->put('/usuario/{id:(\d+)}', '\App\Controllers\UsuariosController::update');
$router->delete('/usuario/{id:(\d+)}', '\App\Controllers\UsuariosController::delete');
