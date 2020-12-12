<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public function show($container, $request)
    {
        $id = $request->attributes->get(1);
        $user = new User($container['db']);
        $data = $user->find($id);
        // echo "<pre>" , print_r($data) , "</pre>";
        return $data;
    }
}
