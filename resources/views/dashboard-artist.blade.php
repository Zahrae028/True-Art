@extends('layouts.app')
@section('title', 'Artist Dashboard')
@section('content')
<div class="dashboard-section">
    <div class="dashboard-title">Artist Dashboard</div>
    <div class="dashboard-content">
        <div style="margin-bottom: 3rem; display: flex; gap: 1rem;">
            <a href="/commissions/manage" class="btn btn-primary" style="flex: 1; text-align: center;">Manage My Commissions</a>
            <a href="/portfolio/create" class="btn btn-secondary" style="flex: 1; text-align: center; background: rgba(139, 92, 246, 0.1); border-color: var(--primary); color: var(--primary);">Add to Portfolio Showcase</a>
        </div>
        
        <h3 class="dashboard-title" style="font-size: 1.5rem;">Active Commissions</h3>
        <div style="display: grid; gap: 1rem;">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section" style="margin-bottom: 0; display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 2rem;">
                        <div>
                            <h4 style="margin: 0; font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-main);">{{ $commission->title }}</h4>
                            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">
                                Client: <span style="font-weight: 600;">{{ $commission->client->name ?? 'Unknown' }}</span> | Status: <span style="color: var(--primary); font-weight: 600;">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <a href="/commission/{{ $commission->id }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">View Details</a>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section" style="text-align: center; border-style: dotted; color: var(--text-dim);">
                    You have no active commissions.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection