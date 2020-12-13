<?php

namespace App\Controllers;

use App\Models\Usuario;

class UsuariosController
{
    public function index($container, $request)
    {
        $usuario = new Usuario($container);
        // $data = $usuario->where('id', '=', 2)->first();
        $data = $usuario->get();
        // $data = $usuario->create(['name' => 'Teste X', 'email' => 'emailx@email.com', 'password' => '123']);
        // $data = $usuario->where('id', '=', 3)->orWhere('id', '=', 4)->update(['name' => 'TESTE']);
        // $data = $usuario->where('id', '=', 4)->delete();
        return $data;
    }

    public function show($container, $request)
    {
        $usuario = new Usuario($container);

        $id = $request->attributes->get(1);
        return $usuario->where('id', '=', $id)->first();
    }

    public function create($container, $request)
    {
        $usuario = new Usuario($container);

        $data = $request->request->all();
        return $usuario->create($data);
    }

    public function update($container, $request)
    {
        $usuario = new Usuario($container);

        $id = $request->attributes->get(1);
        $data = $request->request->all();
        return $usuario->where('id', '=', $id)->update($data);
    }

    public function delete($container, $request)
    {
        $usuario = new Usuario($container);

        $id = $request->attributes->get(1);
        return $usuario->where('id', '=', $id)->delete($id);
    }
}
