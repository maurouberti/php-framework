<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class TasksController extends CrudController
{
    protected function getModel(): string
    {
        return 'tasks_model';
    }
}
