<?php

namespace App\Controllers;

use Firebase\JWT\JWT;
use PHP\Framework\Exceptions\HttpException;

class UsersController
{
    public function register($container, $request)
    {
        $data = $request->request->all();
        return $container['user_model']->create($data);
    }

    public function getToken($container, $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        
        $user = $container['user_model']->getByEmail($email);
        if (!$user) {
            throw new HttpException('Forbidden', 401);
        }
        if (!password_verify($password, $user['password'])) {
            throw new HttpException('Forbidden', 401);
        }

        unset($user['password']);

        $key = 'SECRET JEY xpto';
        $data = [
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24 * 360),
            'user' => $user
        ];
        $token = JWT::encode($data, $key);

        return ['token' => $token];
    }

    public function getCurrentUser($container)
    {
        $token = getallheaders()['Authorization'] ?? null;

        if (!$token) {
            $token = filter_input(\INPUT_GET, 'token');
        }

        if (!$token) {
            throw new HttpException('Forbidden', 401);
        }

        try {
            $key = 'SECRET JEY xpto';
            $data = JWT::decode($token, $key, ['HS256']);
        } catch (\Exception $e) {
            throw new HttpException('Forbidden', 401);
        }

        return (array) $data;
    }
}
