<?php

namespace AppSchedules\Controllers;

use PHP\Framework\CrudController;

class SchedulesController extends CrudController
{
    protected function getModel(): string
    {
        return 'schedules_model';
    }
}
