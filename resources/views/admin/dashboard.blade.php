@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="hero-section text-left py-2">
    <h1 class="hero-title text-3xl">System <span>Overview</span></h1>
    <p class="hero-description m-0 text-base">Welcome back, Administrator. Here is the current pulse of the TrueArt ecosystem.</p>
</div>

<!-- Pulse Stats Grid -->
<!-- Pulse Stats Grid -->
<div class="d-flex gap-3 mb-5 overflow-hidden flex-wrap">
    <div class="dashboard-section flex-1 m-0 p-3 relative overflow-hidden min-w-200">
        <div class="text-xs text-muted text-uppercase ls-wide mb-1">Total Users</div>
        <div class="text-3xl fw-extrabold font-heading text-main">{{ $stats['total_users'] }}</div>
        <div class="absolute opacity-10" style="right: -10px; bottom: -10px;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--primary)"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
    </div>
    
    <div class="dashboard-section flex-1 m-0 p-3 relative overflow-hidden min-w-200">
        <div class="text-xs text-muted text-uppercase ls-wide mb-1">Active Artists</div>
        <div class="text-3xl fw-extrabold font-heading text-primary">{{ $stats['total_artists'] }}</div>
        <div class="absolute opacity-10" style="right: -10px; bottom: -10px;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--primary)"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
        </div>
    </div>

    <div class="dashboard-section flex-1 m-0 p-3 relative overflow-hidden min-w-200">
        <div class="text-xs text-muted text-uppercase ls-wide mb-1">Total Projects</div>
        <div class="text-3xl fw-extrabold font-heading text-accent">{{ $stats['total_commissions'] }}</div>
        <div class="absolute opacity-10" style="right: -10px; bottom: -10px;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--accent)"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
        </div>
    </div>

    <div class="dashboard-section flex-1 m-0 p-3 relative overflow-hidden min-w-200">
        <div class="text-xs text-muted text-uppercase ls-wide mb-1">In Progress</div>
        <div class="text-3xl fw-extrabold font-heading text-success">{{ $stats['active_commissions'] }}</div>
        <div class="absolute opacity-10" style="right: -10px; bottom: -10px;">
            <svg width="100" height="100" viewBox="0 0 24 24" fill="var(--success)"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        </div>
    </div>
</div>

<div class="d-flex gap-4">
    <!-- Recent Users -->
    <div class="dashboard-section flex-1">
        <div class="d-flex justify-between items-center mb-3">
            <h2 class="dashboard-title m-0 text-lg">Recent Registrations</h2>
            <a href="/admin/users" class="text-primary text-xs" style="text-decoration: none;">View All</a>
        </div>
        <div class="d-flex flex-column gap-2">
            @foreach($recentUsers as $user)
            <div class="d-flex items-center gap-2 pb-1 border-tiny border-none" style="border-left: none; border-right: none; border-top: none;">
                <img src="{{ $user->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->email }}" class="rounded-full w-32 h-32" alt="">
                <div class="flex-1">
                    <div class="fw-semibold text-sm text-main">{{ $user->name }}</div>
                    <div class="text-xs text-dim">{{ $user->email }}</div>
                </div>
                <div class="text-xs fw-bold text-uppercase {{ $user->role === 'artist' ? 'text-primary' : 'text-dim' }}">
                    {{ $user->role }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Projects -->
    <div class="dashboard-section flex-1">
        <div class="d-flex justify-between items-center mb-3">
            <h2 class="dashboard-title m-0 text-lg">Top Projects</h2>
            <a href="/admin/commissions" class="text-primary text-xs" style="text-decoration: none;">View All</a>
        </div>
        <div class="d-flex flex-column gap-2">
            @foreach($recentCommissions as $commission)
            <div class="d-flex items-center gap-2 pb-1 border-tiny border-none" style="border-left: none; border-right: none; border-top: none;">
                <div class="flex-1">
                    <div class="fw-semibold text-sm text-main">{{ $commission->title }}</div>
                    <div class="text-xs text-dim">Client: {{ $commission->client->name }} | Artist: {{ $commission->artist->name }}</div>
                </div>
                <div class="text-xs fw-bold text-uppercase text-primary">
                    {{ $commission->status }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
