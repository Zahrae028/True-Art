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

<div class="dashboard-section p-4">
    <div class="text-center mb-4">
        <h2 class="dashboard-title text-2xl mb-2">Latest <span>Masterpieces</span></h2>
        <p class="text-dim m-0 text-lg mx-auto max-w-md">Fresh inspiration from our global creative community.</p>
    </div>

    @if(count($showcase) > 0)
        <div class="post-feed mx-auto max-w-md">
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
                        <h2 class="post-title mb-1">{{ $post->title }}</h2>
                        <p class="post-description m-0">
                            {{ $post->description ?? 'No description provided for this work.' }}
                        </p>
                    </div>
                </div>
            @endforeach
            
            <div class="text-center mt-4">
                <a href="/explore" class="btn btn-primary py-2 px-4">View Global Showcase</a>
            </div>
        </div>
    @else
        <div class="text-center p-4 rounded-sm border-dotted opacity-40">
            <p>The marketplace is just waking up. Be the first to share your work!</p>
        </div>
    @endif
</div>
@endsection