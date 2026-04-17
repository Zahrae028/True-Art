@extends('layouts.app')

@section('content')
<div class="dashboard-section" style="max-width: 400px; margin: 2rem auto;">
    <div class="dashboard-title">Register</div>
    <form action="/register" method="POST" class="commission-form">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="client">Client</option>
            <option value="artist">Artist</option>
        </select>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <p style="margin-top: 1rem; text-align: center;">Already have an account? <a href="/login" class="navbar-link">Login</a></p>
</div>
@endsection
