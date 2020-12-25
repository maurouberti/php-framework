<?php

$container['schedules_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $schedules = new \AppSchedules\Models\Schedules($c);
    $schedules->setUser($id);
    return $schedules;
};
