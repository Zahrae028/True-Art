@extends('layouts.app')
@section('title', 'Browse Artists')
@section('content')
<div class="directory-hero">
    <h1 class="hero-title" style="font-size: 3.5rem; margin-bottom: 1rem;">Master <span>Artists</span></h1>
    <p class="hero-description" style="max-width: 600px; font-size: 1.2rem;">Connect with the visionaries shaping the future of digital art.</p>
    
    <form action="/artists" method="GET" class="search-bar-wrapper">
        <input type="text" name="search" class="search-bar-input" value="{{ $search ?? '' }}" placeholder="Search by name, specialty, or style...">
        <button type="submit" class="search-submit-btn">Search</button>
    </form>
    
    @if($search)
        <div style="margin-top: 2rem; color: var(--text-muted);">
            Showing results for "<span style="color: var(--primary);">{{ $search }}</span>" 
            <a href="/artists" style="margin-left: 1rem; color: var(--text-dim); text-decoration: underline;">Clear Search</a>
        </div>
    @endif
</div>

<div class="artists-grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2.5rem; margin-bottom: 5rem;">
    @forelse($artists as $artist)
        <a href="/artist/{{ $artist->id }}" class="artist-master-card">
            <!-- card content stays same -->
            <div class="artist-card-banner"></div>
            <div class="artist-card-body">
                <img src="{{ $artist->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $artist->email }}" class="artist-master-avatar" alt="">
                
                <div class="artist-badge">{{ $artist->profile->specialty ?? 'Digital Creator' }}</div>
                
                <h3 class="artist-name" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--text-main);">{{ $artist->name }}</h3>
                
                <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 1.5rem; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $artist->profile->bio ?? 'A talented visionary dedicated to pushing the boundaries of digital expression.' }}
                </p>

                <div class="artist-stats" style="display: flex; justify-content: space-between; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.05); margin-top: auto;">
                    <div class="stat-item text-center">
                        <div class="stat-value" style="display: block; font-weight: 700; color: var(--text-main);">{{ $artist->profile->projects_completed ?? 0 }}</div>
                        <div class="stat-label" style="display: block; font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Projects</div>
                    </div>
                    <div style="width: 1px; background: rgba(255,255,255,0.05);"></div>
                    <div class="stat-item text-center">
                        <div class="stat-value" style="display: block; font-weight: 700; color: var(--text-main);">{{ number_format($artist->profile->rating ?? 0.0, 1) }}</div>
                        <div class="stat-label" style="display: block; font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Rating</div>
                    </div>
                    <div style="width: 1px; background: rgba(255,255,255,0.05);"></div>
                    <div class="stat-item text-center">
                        <div class="stat-value" style="display: block; font-weight: 700; color: var(--text-main);">{{ $artist->profile->response_rate ?? 100 }}%</div>
                        <div class="stat-label" style="display: block; font-size: 0.7rem; color: var(--text-dim); text-transform: uppercase;">Response</div>
                    </div>
                </div>

                <div style="color: var(--primary); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 1.5rem;">
                    View Master Profile &rarr;
                </div>
            </div>
        </a>
    @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 5rem 0; color: var(--text-dim);">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 2rem; opacity: 0.2;"><circle cx="12" cy="12" r="10"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
            <p style="font-size: 1.2rem;">No artists found matching your search.</p>
            <a href="/artists" class="btn btn-secondary" style="margin-top: 1rem;">View All Artists</a>
        </div>
    @endforelse
</div>
@endsection