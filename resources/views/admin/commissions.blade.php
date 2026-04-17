@extends('layouts.app')

@section('title', 'Monitor Commissions')

@section('content')
<div class="hero-section" style="padding: 2rem 0; text-align: left;">
    <h1 class="hero-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">Project <span>Oversight</span></h1>
    <p class="hero-description" style="margin: 0; font-size: 1rem;">Monitoring all active and completed art commissions across the platform.</p>
</div>

<div class="dashboard-section" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--border);">
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Project Title</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Collaborators</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Current Status</th>
                <th style="padding: 1.25rem 2rem; font-family: var(--font-heading); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim);">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commissions as $commission)
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.03); transition: var(--transition);" onmouseover="this.style.background='rgba(255,255,255,0.01)'" onmouseout="this.style.background='transparent'">
                <td style="padding: 1.25rem 2rem;">
                    <div style="font-weight: 700; color: var(--text-main); font-size: 1rem;">{{ $commission->title }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.25rem;">Initiated {{ $commission->created_at->diffForHumans() }}</div>
                </td>
                <td style="padding: 1.25rem 2rem;">
                    <div style="font-size: 0.9rem; color: var(--text-muted);">
                        <span style="color: var(--text-main); font-weight: 600;">{{ $commission->client->name }}</span>
                        <span style="opacity: 0.4; margin: 0 0.25rem;">&rarr;</span>
                        <span style="color: var(--primary); font-weight: 600;">{{ $commission->artist->name }}</span>
                    </div>
                </td>
                <td style="padding: 1.25rem 2rem;">
                    <span style="display: inline-block; padding: 0.25rem 0.75rem; border-radius: var(--radius-sm); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; 
                        background: {{ 
                            $commission->status === 'completed' ? 'rgba(34, 197, 94, 0.15)' : 
                            ($commission->status === 'paid' ? 'rgba(59, 130, 246, 0.15)' : 
                            ($commission->status === 'pending' ? 'rgba(234, 179, 8, 0.15)' : 'rgba(139, 92, 246, 0.15)')) 
                        }};
                        color: {{ 
                            $commission->status === 'completed' ? '#4ade80' : 
                            ($commission->status === 'paid' ? '#3b82f6' : 
                            ($commission->status === 'pending' ? '#eab308' : 'var(--primary)')) 
                        }};">
                        {{ $commission->status }}
                    </span>
                </td>
                <td style="padding: 1.25rem 2rem;">
                    <a href="/commission/{{ $commission->id }}" class="btn btn-secondary" style="padding: 0.4rem 0.75rem; font-size: 0.75rem;">View Project</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
