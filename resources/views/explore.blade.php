@extends('layouts.app')

@section('title', 'Explore Art - Discovery Feed')

@section('content')
<div class="hero-section text-center mb-4 py-3">
    <h1 class="hero-title text-2xl mb-1">The <span>Showcase</span></h1>
    <p class="hero-description m-0 text-lg mx-auto max-w-md">Explore the specialized abilities of world-class digital artists.</p>
</div>

<!-- Art Feed -->
<div class="post-feed">
    @foreach($posts as $post)
    <div class="post-card">
        <!-- Header -->
        <div class="post-header">
            <div class="post-artist-info">
                <a href="/artist/{{ $post->user_id }}">
                    <img src="{{ $post->artist->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $post->artist->email }}" class="post-avatar" alt="">
                </a>
                <div>
                    <a href="/artist/{{ $post->user_id }}" class="post-artist-name">{{ $post->artist->name }}</a>
                    <div class="post-artist-specialty">{{ $post->artist->profile->specialty ?? 'Digital Artist' }}</div>
                </div>
            </div>
            <a href="/artist/{{ $post->user_id }}" class="btn btn-secondary py-1 px-2 text-xs">Profile</a>
        </div>

        <!-- Image -->
        <div class="post-image-container">
            <img src="{{ $post->image_path }}" class="post-image" alt="{{ $post->title }}">
        </div>

        <!-- Footer -->
        <div class="post-footer">
            <div class="post-actions">
                @if($post->estimated_price)
                    <div class="post-price-badge">
                        EST. ${{ number_format($post->estimated_price) }}+
                    </div>
                @endif
                <div class="text-xs text-dim">
                    {{ $post->created_at->diffForHumans() }}
                </div>
            </div>
            <h2 class="post-title">{{ $post->title }}</h2>
            <p class="post-description">
                {{ $post->description ?? 'No description provided for this work.' }}
            </p>
        </div>
    </div>
    @endforeach

    @if(count($posts) === 0)
        <div class="text-center p-4 text-dim">
            <svg class="mb-3 opacity-20" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><circle cx="12" cy="12" r="10"/><line x1="14.31" y1="8" x2="20.05" y2="17.94"/><line x1="9.69" y1="8" x2="21.17" y2="8"/><line x1="7.38" y1="12" x2="13.12" y2="2.06"/><line x1="9.69" y1="16" x2="3.95" y2="6.06"/><line x1="14.31" y1="16" x2="2.83" y2="16"/><line x1="16.62" y1="12" x2="10.88" y2="21.94"/></svg>
            <p>The showcase is currently quiet. Be the first to share your work!</p>
        </div>
    @endif
</div>
@endsection
