<?php

$container['projects_model'] = function ($c) {
    return new \AppTasks\Models\Projects($c);
};

$container['tasks_model'] = function ($c) {
    return new \AppTasks\Models\Tasks($c);
};

$container['sections_model'] = function ($c) {
    return new \AppTasks\Models\Sections($c);
};

$container['subtasks_model'] = function ($c) {
    return new \AppTasks\Models\Subtasks($c);
};
