@extends('layouts.app')
@section('title', 'Artist Profile')
@section('content')
<div class="dashboard-section p-0 overflow-hidden mb-0 rounded-bottom-none">
    <div class="profile-banner"></div>
    <div class="d-flex gap-4 items-end mb-4 px-4 mt-neg-lg flex-col-mobile items-center-mobile gap-mobile-2">
        <img src="{{ $artist->profile?->avatar }}" 
             class="profile-avatar-lg" 
             alt="{{ $artist->name }}">
        <div class="pb-1 flex-1 text-left-mobile items-center-mobile d-flex flex-column items-start">
            <h1 class="dashboard-title text-4xl mb-0 ls-tight">{{ $artist->name }}</h1>
            <div class="text-lg text-primary font-heading fw-bold ls-wider text-uppercase">
                {{ $artist->profile->specialty ?? 'Digital Artist' }}
            </div>
        </div>
        <div class="pb-1 w-full-mobile">
            <a href="/commission/request/{{ $artist->id }}" class="btn btn-primary py-3 px-5 text-lg w-full-mobile shadow-purple transition-all">Commission Mastery</a>
        </div>
    </div>
</div>

<div class="grid-2-1 items-start mb-5">
    <div class="dashboard-section">
        <h2 class="dashboard-title text-base mb-3">About the Artist</h2>
        <div class="dashboard-content text-lg lh-extra">
            {{ $artist->profile->bio ?? 'This artist hasn\'t written a bio yet, but their work speaks for itself!' }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3">
        <div class="dashboard-section p-3">
            <h3 class="font-heading fw-bold text-sm mb-2 text-main">Information</h3>
            <div class="d-flex flex-column gap-1 text-sm">
                <div class="d-flex justify-between">
                    <span class="text-dim">Member Since</span>
                    <span class="text-muted">{{ $artist->created_at->format('M Y') }}</span>
                </div>
                <div class="d-flex justify-between">
                    <span class="text-dim">Specialty</span>
                    <span class="text-primary fw-bold">{{ $artist->profile->specialty ?? 'Universal' }}</span>
                </div>
                <div class="d-flex justify-between">
                    <span class="text-dim">Location</span>
                    <span class="text-muted">Remote</span>
                </div>
            </div>
        </div>

        <div class="dashboard-section p-3 bg-gradient-purple">
            <h3 class="font-heading fw-bold text-sm mb-1 text-primary">Secure Payments</h3>
            <p class="text-xs text-muted lh-relaxed">
                TrueArt uses a secure milestone-based payment system. Funds are only released when you are satisfied with the work.
            </p>
        </div>
    </div>
</div>

<!-- Artist Portfolio Showcase -->
<div class="mt-5 pb-5">
    <div class="d-flex justify-between items-center mb-4">
        <h2 class="dashboard-title text-xl m-0">Showcase Portfolio</h2>
        <div class="text-dim text-sm fw-semibold">{{ count($artist->portfolioPosts) }} showcase items</div>
    </div>

    @if(count($artist->portfolioPosts) > 0)
        <div class="grid-showcase">
            @foreach($artist->portfolioPosts as $post)
                <div class="post-card">
                    <div class="post-image-container h-280">
                        <img src="{{ $post->image_path }}" class="post-image">
                        @if($post->estimated_price)
                            <div class="post-price-badge absolute top-1 right-1">
                                EST. ${{ number_format($post->estimated_price) }}+
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-3">
                        <h3 class="font-heading fw-bold text-lg mb-1 text-main">{{ $post->title }}</h3>
                        <p class="text-sm text-dim lh-extra m-0">
                            {{ $post->description ?? 'No context provided for this piece.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="dashboard-section text-center p-5 text-dim border-dotted opacity-40">
            <svg class="mb-3" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
            <div class="fw-semibold">This artist hasn't uploaded any showcase pieces yet.</div>
        </div>
    @endif
</div>
@endsection