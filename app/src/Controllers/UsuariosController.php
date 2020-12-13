<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuariosController
{
    public function show($container, $request)
    {
        $id = $request->attributes->get(1);
        $usuario = new Usuario($container);
        $data = $usuario->find($id);
        $usuario->create(['nome' => 'Mauro']);
        return $data;
    }
}
