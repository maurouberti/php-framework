<?php

$router->get('/api/projects', '\AppTasks\Controllers\ProjectsController::index');
// $router->get('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::show');
$router->post('/api/projects', '\AppTasks\Controllers\ProjectsController::create');
// $router->put('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::update');
// $router->delete('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::delete');

$router->get('/api/tasks', '\AppTasks\Controllers\TasksController::index');
$router->post('/api/tasks', '\AppTasks\Controllers\TasksController::create');

$router->get('/api/sections', '\AppTasks\Controllers\SectionsController::index');
$router->post('/api/sections', '\AppTasks\Controllers\SectionsController::create');

$router->get('/api/subtasks', '\AppTasks\Controllers\SubtasksController::index');
$router->post('/api/subtasks', '\AppTasks\Controllers\SubtasksController::create');
