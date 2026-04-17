@extends('layouts.app')

@section('content')
<div class="dashboard-section" style="max-width: 400px; margin: 2rem auto;">
    <div class="dashboard-title">Login</div>
    <form action="/login" method="POST" class="commission-form">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p style="margin-top: 1rem; text-align: center;">Don't have an account? <a href="/register" class="navbar-link">Register</a></p>
</div>
@endsection
