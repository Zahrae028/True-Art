<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrueArt - @yield('title', 'Art Commission Marketplace')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="navbar">
        <a href="/" class="navbar-logo" style="text-decoration: none;">
            True<span>Art</span><div class="logo-dot"></div>
        </a>
        <div class="navbar-links">
            @if(Auth::check())
                @php $role = Auth::user()->role ?? 'client'; @endphp
                @if($role === 'client')
                    <a href="/" class="navbar-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
                    <a href="/explore" class="navbar-link{{ request()->is('explore') ? ' active' : '' }}">Explore</a>
                    <a href="/artists" class="navbar-link{{ request()->is('artists') ? ' active' : '' }}">Artists</a>
                    <a href="/dashboard" class="navbar-link{{ request()->is('dashboard') ? ' active' : '' }}">Dashboard</a>
                    <a href="/messages" class="navbar-link{{ request()->is('messages') ? ' active' : '' }}">Messages</a>
                    <a href="/profile" class="navbar-link{{ request()->is('profile') ? ' active' : '' }}">Profile</a>
                @elseif($role === 'artist')
                    <a href="/" class="navbar-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
                    <a href="/dashboard/artist" class="navbar-link{{ request()->is('dashboard/artist') ? ' active' : '' }}">Dashboard</a>
                    <a href="/commissions/manage" class="navbar-link{{ request()->is('commissions/manage') ? ' active' : '' }}">Commissions</a>
                    <a href="/messages" class="navbar-link{{ request()->is('messages') ? ' active' : '' }}">Messages</a>
                    <a href="/profile/artist" class="navbar-link{{ request()->is('profile/artist') ? ' active' : '' }}">Profile</a>
                @elseif($role === 'admin')
                    <a href="/admin/dashboard" class="navbar-link{{ request()->is('admin/dashboard') ? ' active' : '' }}">Admin Panel</a>
                    <a href="/admin/users" class="navbar-link{{ request()->is('admin/users') ? ' active' : '' }}">Users</a>
                    <a href="/admin/commissions" class="navbar-link{{ request()->is('admin/commissions') ? ' active' : '' }}">Projects</a>
                @endif
                <form action="/logout" method="POST" style="display:inline; margin-left:1.5rem;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            @else
                <a href="/" class="navbar-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
                <a href="/artists" class="navbar-link{{ request()->is('artists') ? ' active' : '' }}">Artists</a>
                <a href="/login" class="navbar-link{{ request()->is('login') ? ' active' : '' }}">Login</a>
                <a href="/register" class="navbar-link{{ request()->is('register') ? ' active' : '' }}">Register</a>
            @endif
        </div>
    </nav>
    <main>
        @if(session('success'))
            <div style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-weight: 500; display: flex; align-items: center; gap: 0.75rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 2rem; font-weight: 500; display: flex; align-items: center; gap: 0.75rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
