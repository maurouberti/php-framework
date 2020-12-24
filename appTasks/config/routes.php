<?php

$router->get('/api/projects', '\AppTasks\Controllers\ProjectsController::index');
// $router->get('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::show');
$router->post('/api/projects', '\AppTasks\Controllers\ProjectsController::create');
// $router->put('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::update');
// $router->delete('/api/projects/{id:(\d+)}', '\AppTasks\Controllers\ProjectsController::delete');

$router->get('/api/tasks', '\AppTasks\Controllers\TasksController::listByProject');
$router->post('/api/tasks', '\AppTasks\Controllers\TasksController::create');

$router->get('/api/sections', '\AppTasks\Controllers\SectionsController::listByProject');
$router->post('/api/sections', '\AppTasks\Controllers\SectionsController::create');

$router->get('/api/subtasks', '\AppTasks\Controllers\SubtasksController::listByTask');
$router->post('/api/subtasks', '\AppTasks\Controllers\SubtasksController::create');
$router->put('/api/subtasks/{id:(\d+)}', '\AppTasks\Controllers\SubtasksController::update');
