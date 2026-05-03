@extends('layouts.app')
@section('title', 'Browse Artists')
@section('content')
<div class="directory-hero">
    <h1 class="hero-title text-3xl mb-1">Master <span>Artists</span></h1>
    <p class="hero-description text-xl mx-auto max-w-md">Connect with the visionaries shaping the future of digital art.</p>
    
    <form action="/artists" method="GET" class="search-bar-wrapper">
        <input type="text" name="search" class="search-bar-input" value="{{ $search ?? '' }}" placeholder="Search by name, specialty, or style...">
        <button type="submit" class="search-submit-btn">Search</button>
    </form>
    
    @if($search)
        <div class="mt-2 text-muted">
            Showing results for "<span class="text-primary">{{ $search }}</span>" 
            <a href="/artists" class="ms-1 text-dim text-underline">Clear Search</a>
        </div>
    @endif
</div>

<div class="artists-grid mb-5">
    @forelse($artists as $artist)
        <a href="/artist/{{ $artist->id }}" class="artist-master-card">
            <!-- card content stays same -->
            <div class="artist-card-banner"></div>
            <div class="artist-card-body">
                <img src="{{ $artist->profile?->avatar }}" class="artist-master-avatar" alt="">
                
                <div class="artist-badge">{{ $artist->profile->specialty ?? 'Digital Creator' }}</div>
                
                <h3 class="artist-name text-lg mb-1 text-main">{{ $artist->name }}</h3>
                
                <p class="text-sm text-muted mb-2 clamp-2" style="line-height: 1.6;">
                    {{ $artist->profile->bio ?? 'A talented visionary dedicated to pushing the boundaries of digital expression.' }}
                </p>

                <div class="text-primary fw-bold text-sm text-uppercase ls-wide mt-auto">
                    View Master Profile &rarr;
                </div>
            </div>
        </a>
    @empty
        <div class="text-center p-5 text-dim grid-full">
            <svg class="mb-4 opacity-20" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            <p class="text-lg">No artists found matching your search.</p>
            <a href="/artists" class="btn btn-secondary mt-1">View All Artists</a>
        </div>
    @endforelse
</div>
@endsection