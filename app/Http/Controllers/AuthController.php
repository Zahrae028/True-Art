<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $this->authService->register($request->all());
        return redirect('/login');
    }

    public function login(Request $request)
    {
        $user = $this->authService->login($request->all());

        if ($user) {
            return redirect('/dashboard');
        }

        return back();
    }
}