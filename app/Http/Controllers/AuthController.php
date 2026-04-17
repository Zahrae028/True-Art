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
            if ($user->is_banned) {
                \Illuminate\Support\Facades\Auth::logout();
                return redirect('/login')->with('error', 'Your account has been suspended. Please contact support.');
            }

            // Redirect based on role
            if ($user->role === 'artist') {
                return redirect('/dashboard/artist');
            }
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/dashboard');
        }

        return back();
    }

    public function logout()
    {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/');
    }
}