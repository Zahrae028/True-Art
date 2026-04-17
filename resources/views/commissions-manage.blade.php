@extends('layouts.app')
@section('title', 'Manage Commissions')
@section('content')
<div class="dashboard-section">
    <div class="dashboard-title">Manage Commissions</div>
    <div class="dashboard-content">
        <h3 class="dashboard-title" style="font-size: 1.5rem;">Incoming Requests & Projects</h3>
        
        <div style="display: grid; gap: 1rem; margin-top: 1.5rem;">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section" style="margin-bottom: 0; display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 2rem;">
                        <div>
                            <h4 style="margin: 0; font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-main);">{{ $commission->title }}</h4>
                            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">
                                Client: <span style="font-weight: 600;">{{ $commission->client->name }}</span> | Status: <span style="color: var(--primary); font-weight: 600;">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.75rem; align-items: center;">
                            <a href="/commission/{{ $commission->id }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                                {{ $commission->status === 'pending' ? 'Review & Quote' : 'View Workspace' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section" style="text-align: center; border-style: dotted; color: var(--text-dim); padding: 3rem;">
                    <div style="margin-bottom: 1rem; opacity: 0.5;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                    </div>
                    <div>No commission requests found. Browse the market to attract new clients!</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection