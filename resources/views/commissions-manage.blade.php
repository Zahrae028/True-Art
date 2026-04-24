@extends('layouts.app')
@section('title', 'Manage Commissions')
@section('content')
<div class="dashboard-section">
    <div class="dashboard-title">Manage Commissions</div>
    <div class="dashboard-content">
        <h3 class="dashboard-title text-base">Incoming Requests & Projects</h3>
        
        <div class="d-grid gap-2 mt-3">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section mb-0 d-flex items-center justify-between p-3 px-4">
                        <div>
                            <h4 class="m-0 font-heading text-lg text-main">{{ $commission->title }}</h4>
                            <div class="text-sm text-muted mt-1">
                                Client: <span class="fw-semibold">{{ $commission->client->name }}</span> | Status: <span class="text-primary fw-semibold">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 items-center">
                            <a href="/commission/{{ $commission->id }}" class="btn btn-secondary py-1 px-2 text-sm">
                                {{ $commission->status === 'pending' ? 'Review & Quote' : 'View Workspace' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section text-center text-dim p-4 border-dotted">
                    <div class="mb-2 opacity-50">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                    </div>
                    <div>No commission requests found. Browse the market to attract new clients!</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection