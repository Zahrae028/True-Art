@extends('layouts.app')

@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-sm">
    <div class="dashboard-title text-center">Login</div>
    <form action="/login" method="POST" class="commission-form p-0 border-none b-transparent">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-primary w-full py-2">Login</button>
    </form>
    <p class="text-center mt-2 text-sm text-dim">Don't have an account? <a href="/register" class="text-primary">Register</a></p>
</div>
@endsection
