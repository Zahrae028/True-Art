@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="hero-section text-left py-2 d-flex justify-between items-center">
    <div>
        <h1 class="hero-title text-3xl mb-0">User <span>Registry</span></h1>
        <p class="hero-description m-0 text-base">Comprehensive management of all platform stakeholders.</p>
    </div>
</div>

<div class="dashboard-section p-0 overflow-hidden">
    <table class="w-full text-left collapse">
        <thead>
            <tr class="border-bottom bg-tiny">
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Member</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Role</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Email</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Joined</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="transition-all border-tiny border-none hover-bg-tiny" style="border-left: none; border-right: none; border-top: none;">
                <td class="p-3">
                    <div class="d-flex items-center gap-2">
                        <img src="{{ $user->profile?->avatar }}" class="rounded-full w-40 h-40 object-cover {{ $user->is_banned ? 'border-error' : '' }}" style="border-width: 2px; border-style: solid;" alt="">
                        <div>
                            <div class="fw-semibold {{ $user->is_banned ? 'text-error' : 'text-main' }}">
                                {{ $user->name }}
                                @if($user->is_banned)
                                    <span class="text-xs bg-error text-white px-1 rounded-sm ms-1" style="font-size: 0.6rem;">BANNED</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td class="p-3">
                    <span class="d-inline p-1 rounded-full text-xs fw-bold text-uppercase 
                        {{ $user->role === 'artist' ? 'bg-primary-tiny text-primary' : ($user->role === 'admin' ? 'bg-accent-tiny text-accent' : 'bg-tiny text-dim') }}">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="p-3 text-muted text-sm">{{ $user->email }}</td>
                <td class="p-3 text-dim text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                <td class="p-3">
                    <div class="d-flex gap-2">
                        <a href="{{ $user->role === 'artist' ? '/artist/'.$user->id : '#' }}" class="btn btn-secondary py-1 px-2 text-xs">Profile</a>
                        
                        @if($user->id !== auth()->id())
                            <form action="/admin/user/{{ $user->id }}/toggle-ban" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn py-1 px-2 text-xs fw-bold rounded-sm 
                                    {{ $user->is_banned ? 'bg-success text-white border-success' : 'bg-error-tiny text-error border-error' }}">
                                    {{ $user->is_banned ? 'Unban' : 'Ban' }}
                                </button>
                            </form>
                            
                            @if($user->role !== 'admin')
                                <form action="/admin/user/{{ $user->id }}/promote-admin" method="POST" class="d-inline" onsubmit="return confirm('Promote this user to Administrator?')">
                                    @csrf
                                    <button type="submit" class="btn btn-primary py-1 px-2 text-xs bg-accent border-none">
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
