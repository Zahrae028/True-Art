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
        <a href="/" class="navbar-logo">
            True<span>Art</span><div class="logo-dot"></div>
        </a>
        
        <input type="checkbox" id="menu-toggle-input" class="d-none">
        
        <label for="menu-toggle-input" class="menu-trigger">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </label>

        <label for="menu-toggle-input" class="mobile-menu-overlay"></label>
        
        <div class="mobile-drawer">
            <div class="drawer-header">
                <div class="d-flex justify-between items-start mb-4">
                    <div class="drawer-user-info flex-1">
                        @if(Auth::check())
                            <img src="{{ Auth::user()->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . Auth::user()->email }}" class="drawer-avatar mb-3">
                            <div class="fw-black text-3xl text-main ls-tight mb-1">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-primary text-uppercase fw-bold ls-wider">Mastery {{ Auth::user()->role }}</div>
                        @else
                            <div class="drawer-avatar d-flex items-center justify-center bg-primary-tiny mb-3">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div class="fw-black text-3xl text-main ls-tight mb-1">TrueArt</div>
                            <div class="text-sm text-dim text-uppercase ls-wider">Join the Elite Marketplace</div>
                        @endif
                    </div>
                    <label for="menu-toggle-input" class="cursor-pointer text-dim p-2 hover-bg-tiny rounded-sm transition-all">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </label>
                </div>
            </div>

            <div class="drawer-content">
                @if(Auth::check())
                    @php $role = Auth::user()->role; @endphp
                    @if($role === 'client')
                        <a href="/" class="drawer-link{{ request()->is('/') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Home
                        </a>
                        <a href="/explore" class="drawer-link{{ request()->is('explore') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            Explore
                        </a>
                        <a href="/artists" class="drawer-link{{ request()->is('artists') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Artists
                        </a>
                        <a href="/dashboard" class="drawer-link{{ request()->is('dashboard') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Dashboard
                        </a>
                        <a href="/messages" class="drawer-link{{ request()->is('messages') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Messages
                        </a>
                        <a href="/profile" class="drawer-link{{ request()->is('profile') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profile
                        </a>
                    @elseif($role === 'artist')
                        <a href="/" class="drawer-link{{ request()->is('/') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Home
                        </a>
                        <a href="/dashboard/artist" class="drawer-link{{ request()->is('dashboard/artist') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Studio
                        </a>
                        <a href="/commissions/manage" class="drawer-link{{ request()->is('commissions/manage') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            Commissions
                        </a>
                        <a href="/messages" class="drawer-link{{ request()->is('messages') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Messages
                        </a>
                        <a href="/profile/artist" class="drawer-link{{ request()->is('profile/artist') ? ' active' : '' }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profile
                        </a>
                    @endif
                @else
                    <a href="/" class="drawer-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Discover
                    </a>
                    <a href="/artists" class="drawer-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Find Artists
                    </a>
                    <a href="/login" class="drawer-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                        Sign In
                    </a>
                    <a href="/register" class="btn btn-primary w-full mt-3">Start Collecting</a>
                @endif
            </div>

            @if(Auth::check())
                <div class="drawer-footer">
                    <form action="/logout" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-full">Sign Out</button>
                    </form>
                </div>
            @endif
        </div>

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
                <form action="/logout" method="POST" class="d-inline ms-3">
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
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
