<?php

namespace App\Services;

use App\User;

class UserService
{
    public function loadAll()
    {
        return User::where('role', '<>', User::USER_ROLE_SUPER_ADMIN)->get();
    }

    public function add($data)
    {
        User::create([
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

    }
}