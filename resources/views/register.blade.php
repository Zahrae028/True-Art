@extends('layouts.app')

@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-sm">
    <div class="dashboard-title text-center">Register</div>
    <form action="/register" method="POST" class="commission-form p-0 border-none b-transparent">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="role">I am a...</label>
            <select id="role" name="role" required>
                <option value="client">Client (Collector)</option>
                <option value="artist">Artist (Creator)</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-full py-2">Create Account</button>
    </form>
    <p class="text-center mt-2 text-sm text-dim">Already have an account? <a href="/login" class="text-primary">Login</a></p>
</div>
@endsection
