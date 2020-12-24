<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class SubtasksController extends CrudController
{
    protected function getModel(): string
    {
        return 'subtasks_model';
    }

    public function listByTask($container, $request)
    {
        $id = (int) $request->query->get('id');
        return $container['subtasks_model']->where('task_id', '=', $id)->get();
    }
}
