<?php

$router->get('/api/schedules', '\AppSchedules\Controllers\SchedulesController::index');
$router->post('/api/schedules', '\AppSchedules\Controllers\SchedulesController::create');
