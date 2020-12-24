<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class TasksController extends CrudController
{
    protected function getModel(): string
    {
        return 'tasks_model';
    }

    public function listByProject($container, $request)
    {
        $id = (int) $request->query->get('id');
        return $container['tasks_model']->getByProjectId($id);
    }
}
