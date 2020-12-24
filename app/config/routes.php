<?php

$router->get('/', function() {
    return file_get_contents(__DIR__ . '/../../public/index.html');
});

$router->post('/auth/register', '\App\Controllers\UsersController::register');
$router->post('/auth/token', '\App\Controllers\UsersController::getToken');
$router->get('/api/me', '\App\Controllers\UsersController::getCurrentUser');
