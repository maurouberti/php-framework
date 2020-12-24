<?php

namespace App\Models;

use PHP\Framework\Model;

class User extends Model
{
    protected $table = 'users';

    public function setPassword(string $password)
    {
        return password_hash($password, \PASSWORD_DEFAULT);
    }

    public function getByEmail(string $email)
    {
        return parent::where('email', '=', $email)->first();
    }
}
