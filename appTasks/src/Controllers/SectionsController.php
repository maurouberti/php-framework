<?php

namespace AppTasks\Controllers;

use PHP\Framework\CrudController;

class SectionsController extends CrudController
{
    protected function getModel(): string
    {
        return 'sections_model';
    }

    public function listByProject($container, $request)
    {
        $id = $request->query->get('id');
        return $container['sections_model']->where('project_id', '=', $id)->get();
    }
}
