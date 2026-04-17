@extends('layouts.app')
@section('title', 'Artist Profile')
@section('content')
<div class="dashboard-section" style="padding: 0; overflow: hidden; border-bottom: none; border-radius: var(--radius) var(--radius) 0 0;">
    <div style="height: 150px; background: linear-gradient(135deg, var(--bg-darker) 0%, var(--primary) 100%); opacity: 0.3;"></div>
    <div style="padding: 0 3rem; margin-top: -75px; display: flex; gap: 2.5rem; align-items: flex-end; margin-bottom: 3rem;">
        <img src="{{ $artist->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $artist->email }}" 
             style="width: 180px; height: 180px; border-radius: var(--radius); border: 4px solid var(--bg-card); box-shadow: var(--shadow-purple); object-fit: cover; background: var(--bg-card); position: relative; z-index: 10;" 
             alt="{{ $artist->name }}">
        <div style="padding-bottom: 1rem; flex: 1;">
            <h1 class="dashboard-title" style="font-size: 2.5rem; margin-bottom: 0.25rem;">{{ $artist->name }}</h1>
            <div style="font-size: 1.1rem; color: var(--primary); font-family: var(--font-heading); font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase;">
                {{ $artist->profile->specialty ?? 'Digital Artist' }}
            </div>
        </div>
        <div style="padding-bottom: 1rem;">
            <a href="/commission/request/{{ $artist->id }}" class="btn btn-primary" style="padding: 1rem 2rem;">Commission Me</a>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start; margin-bottom: 4rem;">
    <div class="dashboard-section">
        <h2 class="dashboard-title" style="font-size: 1.5rem; margin-bottom: 1.5rem;">About the Artist</h2>
        <div class="dashboard-content" style="line-height: 1.8; font-size: 1.05rem;">
            {{ $artist->profile->bio ?? 'This artist hasn\'t written a bio yet, but their work speaks for itself!' }}
        </div>
    </div>

    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="dashboard-section" style="padding: 1.5rem;">
            <h3 style="font-family: var(--font-heading); font-weight: 700; font-size: 1.1rem; margin-bottom: 1rem; color: var(--text-main);">Information</h3>
            <div style="display: flex; flex-direction: column; gap: 0.75rem; font-size: 0.9rem;">
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--text-dim);">Member Since</span>
                    <span style="color: var(--text-muted);">{{ $artist->created_at->format('M Y') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--text-dim);">Specialty</span>
                    <span style="color: var(--primary); font-weight: 700;">{{ $artist->profile->specialty ?? 'Universal' }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: var(--text-dim);">Location</span>
                    <span style="color: var(--text-muted);">Remote</span>
                </div>
            </div>
        </div>

        <div class="dashboard-section" style="padding: 1.5rem; background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, transparent 100%);">
            <h3 style="font-family: var(--font-heading); font-weight: 700; font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--primary);">Secure Payments</h3>
            <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5;">
                TrueArt uses a secure milestone-based payment system. Funds are only released when you are satisfied with the work.
            </p>
        </div>
    </div>
</div>

<!-- Artist Portfolio Showcase -->
<div style="margin-top: 4rem; padding-bottom: 5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 class="dashboard-title" style="font-size: 1.8rem; margin: 0;">Showcase Portfolio</h2>
        <div style="color: var(--text-dim); font-size: 0.9rem; font-weight: 600;">{{ count($artist->portfolioPosts) }} showcase items</div>
    </div>

    @if(count($artist->portfolioPosts) > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 2.5rem;">
            @foreach($artist->portfolioPosts as $post)
                <div style="background: var(--bg-card); border-radius: var(--radius); overflow: hidden; border: 1px solid var(--border); transition: var(--transition);" 
                     onmouseover="this.style.borderColor = 'var(--primary)'; this.style.transform = 'translateY(-5px)'" 
                     onmouseout="this.style.borderColor = 'var(--border)'; this.style.transform = 'translateY(0)'">
                    
                    <div style="height: 280px; overflow: hidden; position: relative;">
                        <img src="{{ $post->image_path }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);" 
                             onmouseover="this.style.transform = 'scale(1.05)'" onmouseout="this.style.transform = 'scale(1)'">
                        @if($post->estimated_price)
                            <div style="position: absolute; top: 1.25rem; right: 1.25rem; background: rgba(13, 13, 20, 0.9); color: var(--primary); font-size: 0.8rem; font-weight: 800; padding: 0.5rem 1rem; border-radius: var(--radius-sm); border: 1px solid var(--primary); backdrop-filter: blur(8px); box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
                                EST. ${{ number_format($post->estimated_price) }}+
                            </div>
                        @endif
                    </div>
                    
                    <div style="padding: 1.75rem;">
                        <h3 style="font-family: var(--font-heading); font-weight: 800; font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--text-main);">{{ $post->title }}</h3>
                        <p style="font-size: 0.9rem; color: var(--text-dim); line-height: 1.8; margin: 0;">
                            {{ $post->description ?? 'No context provided for this piece.' }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="dashboard-section" style="text-align: center; padding: 6rem 2rem; border-style: dashed; opacity: 0.4;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 1.5rem;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
            <div style="font-weight: 600;">This artist hasn't uploaded any showcase pieces yet.</div>
        </div>
    @endif
</div>
@endsection