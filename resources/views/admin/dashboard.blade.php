@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="hero-section" style="padding: 2rem 0; text-align: left;">
    <h1 class="hero-title" style="font-size: 2.5rem;">System <span>Overview</span></h1>
    <p class="hero-description" style="margin: 0; font-size: 1rem;">Welcome back, Administrator. Here is the current pulse of the TrueArt ecosystem.</p>
</div>

<!-- Pulse Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
    <div class="dashboard-section" style="margin: 0; padding: 1.5rem; position: relative; overflow: hidden;">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Users</div>
        <div style="font-size: 2.5rem; font-weight: 800; font-family: var(--font-heading); color: var(--text-main);">{{ $stats['total_users'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--primary)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
    </div>
    
    <div class="dashboard-section" style="margin: 0; padding: 1.5rem; position: relative; overflow: hidden;">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Active Artists</div>
        <div style="font-size: 2.5rem; font-weight: 800; font-family: var(--font-heading); color: var(--primary);">{{ $stats['total_artists'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--primary)"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
        </div>
    </div>

    <div class="dashboard-section" style="margin: 0; padding: 1.5rem; position: relative; overflow: hidden;">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Total Projects</div>
        <div style="font-size: 2.5rem; font-weight: 800; font-family: var(--font-heading); color: var(--accent);">{{ $stats['total_commissions'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--accent)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        </div>
    </div>

    <div class="dashboard-section" style="margin: 0; padding: 1.5rem; position: relative; overflow: hidden;">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">In Progress</div>
        <div style="font-size: 2.5rem; font-weight: 800; font-family: var(--font-heading); color: #22c55e;">{{ $stats['active_commissions'] }}</div>
        <div style="position: absolute; right: -10px; bottom: -10px; opacity: 0.1;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="#22c55e"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- Recent Users -->
    <div class="dashboard-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 class="dashboard-title" style="margin: 0; font-size: 1.25rem;">Recent Registrations</h2>
            <a href="/admin/users" style="color: var(--primary); font-size: 0.85rem; text-decoration: none;">View All</a>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($recentUsers as $user)
            <div style="display: flex; align-items: center; gap: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.03);">
                <img src="{{ $user->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->email }}" style="width: 32px; height: 32px; border-radius: 50%;" alt="">
                <div style="flex: 1;">
                    <div style="font-weight: 600; font-size: 0.9rem; color: var(--text-main);">{{ $user->name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $user->email }}</div>
                </div>
                <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: {{ $user->role === 'artist' ? 'var(--primary)' : 'var(--text-muted)' }};">
                    {{ $user->role }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="dashboard-section">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 class="dashboard-title" style="margin: 0; font-size: 1.25rem;">Top Projects</h2>
            <a href="/admin/commissions" style="color: var(--primary); font-size: 0.85rem; text-decoration: none;">View All</a>
        </div>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($recentCommissions as $commission)
            <div style="display: flex; align-items: center; gap: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.03);">
                <div style="flex: 1;">
                    <div style="font-weight: 600; font-size: 0.9rem; color: var(--text-main);">{{ $commission->title }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-dim);">Client: {{ $commission->client->name }} | Artist: {{ $commission->artist->name }}</div>
                </div>
                <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: var(--primary);">
                    {{ $commission->status }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
