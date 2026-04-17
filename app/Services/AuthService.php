<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function register($data)
    {
        return User::create([
            'name' => $data['name'] ?? 'Guest User',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'client',
        ]);
    }

    public function login($data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            return \Illuminate\Support\Facades\Auth::user();
        }

        return null;
    }
}