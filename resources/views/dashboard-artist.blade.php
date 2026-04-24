@extends('layouts.app')
@section('title', 'Artist Dashboard')
@section('content')
<div class="dashboard-section">
    <div class="dashboard-title">Artist Dashboard</div>
    <div class="dashboard-content">
        <div class="mb-3 d-flex gap-2">
            <a href="/commissions/manage" class="btn btn-primary flex-1 text-center">Manage My Commissions</a>
            <a href="/portfolio/create" class="btn btn-secondary flex-1 text-center bg-primary-tiny" style="border-color: var(--primary); color: var(--primary);">Add to Portfolio Showcase</a>
        </div>
        
        <h3 class="dashboard-title text-base">Active Commissions</h3>
        <div class="d-grid gap-2">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section mb-0 d-flex items-center justify-between p-3 px-4">
                        <div>
                            <h4 class="m-0 font-heading text-lg text-main">{{ $commission->title }}</h4>
                            <div class="text-sm text-muted mt-1">
                                Client: <span class="fw-semibold">{{ $commission->client->name ?? 'Unknown' }}</span> | Status: <span class="text-primary fw-semibold">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <a href="/commission/{{ $commission->id }}" class="btn btn-secondary py-1 px-2 text-sm">View Details</a>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section text-center text-dim rounded-sm border-dotted">
                    You have no active commissions.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection