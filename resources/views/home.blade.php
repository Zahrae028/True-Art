@extends('layouts.app')
@section('title', 'Welcome to TrueArt')
@section('content')
<div class="hero-section">
    <h1 class="hero-title">The Premium Art Commission <span>Marketplace</span></h1>
    <p class="hero-description">
        Connect with world-class digital artists. From concept art to final delivery, manage your entire creative workflow in one stunning workspace.
    </p>
    <div class="hero-actions">
        <a href="/artists" class="btn btn-primary">Browse Artists</a>
        <a href="/register" class="btn btn-secondary">Get Started</a>
    </div>
</div>

<div class="dashboard-section" style="padding: 4rem 1rem;">
    <div style="text-align: center; margin-bottom: 4rem;">
        <h2 class="dashboard-title" style="font-size: 2.5rem; margin-bottom: 1rem;">Latest <span>Masterpieces</span></h2>
        <p style="color: var(--text-dim); margin: 0; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Fresh inspiration from our global creative community.</p>
    </div>

    @if(count($showcase) > 0)
        <div class="post-feed" style="max-width: 550px;">
            @foreach($showcase as $post)
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
                        <a href="/artist/{{ $post->user_id }}" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">Profile</a>
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
                            <div style="font-size: 0.75rem; color: var(--text-dim);">
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <h2 class="post-title" style="margin-bottom: 0.5rem;">{{ $post->title }}</h2>
                        <p class="post-description" style="margin: 0;">
                            {{ $post->description ?? 'No description provided for this work.' }}
                        </p>
                    </div>
                </div>
            @endforeach
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="/explore" class="btn btn-primary" style="padding: 1rem 3rem;">View Global Showcase</a>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0; border: 2px dashed var(--border); border-radius: var(--radius); opacity: 0.4;">
            <p>The marketplace is just waking up. Be the first to share your work!</p>
        </div>
    @endif
</div>
@endsection