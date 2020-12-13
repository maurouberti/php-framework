<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function show($container, $request)
    {
        $id = $request->attributes->get(1);
        $user = new User($container);
        $data = $user->find($id);
        $user->create(['nome' => 'Mauro']);
        return $data;
    }
}
