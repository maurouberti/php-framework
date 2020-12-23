<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class ProjectsController extends CrudController
{
    protected function getModel(): string
    {
        return 'projects_model';
    }
}
