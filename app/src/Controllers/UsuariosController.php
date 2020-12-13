<?php

namespace App\Controllers;

use PHP\Framework\CrudController;

class UsuariosController extends CrudController
{
    protected function getModel(): string
    {
        return 'usuario_model';
    }
}
