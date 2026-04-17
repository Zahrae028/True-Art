@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="hero-section" style="padding: 2rem 0; text-align: left; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h1 class="hero-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">User <span>Registry</span></h1>
        <p class="hero-description" style="margin: 0; font-size: 1rem;">Comprehensive management of all platform stakeholders.</p>
    </div>
</div>

<div class="dashboard-section" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--border);">
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Member</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Role</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Email</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Joined</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.03); transition: var(--transition);" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.25rem 2rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <img src="{{ $user->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->email }}" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid {{ $user->is_banned ? '#ef4444' : 'var(--border)' }};" alt="">
                        <div>
                            <div style="font-weight: 600; color: {{ $user->is_banned ? '#ef4444' : 'var(--text-main)' }};">
                                {{ $user->name }}
                                @if($user->is_banned)
                                    <span style="font-size: 0.6rem; background: #ef4444; color: white; padding: 0.1rem 0.4rem; border-radius: 4px; margin-left: 0.5rem; vertical-align: middle;">BANNED</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td style="padding: 1.25rem 2rem;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; 
                        background: {{ $user->role === 'artist' ? 'rgba(139, 92, 246, 0.15)' : ($user->role === 'admin' ? 'rgba(217, 70, 239, 0.15)' : 'rgba(255, 255, 255, 0.05)') }};
                        color: {{ $user->role === 'artist' ? 'var(--primary)' : ($user->role === 'admin' ? 'var(--accent)' : 'var(--text-muted)') }};">
                        {{ $user->role }}
                    </span>
                </td>
                <td style="padding: 1.25rem 2rem; color: var(--text-muted); font-size: 0.9rem;">{{ $user->email }}</td>
                <td style="padding: 1.25rem 2rem; color: var(--text-dim); font-size: 0.85rem;">{{ $user->created_at->format('M d, Y') }}</td>
                <td style="padding: 1.25rem 2rem;">
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ $user->role === 'artist' ? '/artist/'.$user->id : '#' }}" class="btn btn-secondary" style="padding: 0.4rem 0.75rem; font-size: 0.75rem;">Profile</a>
                        
                        @if($user->id !== auth()->id())
                            <form action="/admin/user/{{ $user->id }}/toggle-ban" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn" style="padding: 0.4rem 0.75rem; font-size: 0.75rem; background: {{ $user->is_banned ? '#22c55e' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $user->is_banned ? 'white' : '#ef4444' }}; border: 1px solid {{ $user->is_banned ? '#22c55e' : '#ef4444' }}; border-radius: var(--radius-sm); font-weight: 700;">
                                    {{ $user->is_banned ? 'Unban' : 'Ban' }}
                                </button>
                            </form>
                            
                            @if($user->role !== 'admin')
                                <form action="/admin/user/{{ $user->id }}/promote-admin" method="POST" style="display:inline;" onsubmit="return confirm('Promote this user to Administrator? This granting full system access.')">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="padding: 0.4rem 0.75rem; font-size: 0.75rem; background: var(--accent); border-color: var(--accent);">
                                        Make Admin
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
