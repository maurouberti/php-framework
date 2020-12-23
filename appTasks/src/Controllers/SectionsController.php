<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class SectionsController extends CrudController
{
    protected function getModel(): string
    {
        return 'sections_model';
    }
}
