<?php

$container['projects_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $projects = new \AppTasks\Models\Projects($c);
    $projects->setUser($id);
    return $projects;
};

$container['tasks_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $tasks = new \AppTasks\Models\Tasks($c);
    $tasks->setUser($id);
    return $tasks;
};

$container['sections_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $sections = new \AppTasks\Models\Sections($c);
    $sections->setUser($id);
    return $sections;
};

$container['subtasks_model'] = function ($c) {
    $id = $c['loggedUser']['user']->id;
    $subtasks = new \AppTasks\Models\Subtasks($c);
    $subtasks->setUser($id);
    return $subtasks;
};
