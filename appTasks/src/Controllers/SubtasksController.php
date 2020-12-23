<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class SubtasksController extends CrudController
{
    protected function getModel(): string
    {
        return 'subtasks_model';
    }
}
