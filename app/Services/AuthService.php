<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function register($data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
    }

    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();

        if ($user && password_verify($data['password'], $user->password)) {
            session(['user_id' => $user->id]);
            return $user;
        }

        return null;
    }
}