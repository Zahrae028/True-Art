@extends('layouts.app')
@section('title', 'Client Dashboard')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-lg">
    <div class="dashboard-title">Client Dashboard</div>
    <div class="dashboard-content">
        <a href="/commission/request" class="btn btn-primary mb-4">Request New Commission</a>
        <h3 class="mt-4 font-heading text-lg">My Commissions</h3>
        @if(isset($commissions) && count($commissions) > 0)
            @foreach($commissions as $commission)
                <div class="artist-card d-flex items-center justify-between mb-1 py-1 px-3">
                    <div class="m-0">
                        <h4 class="m-0 text-main">{{ $commission->title }}</h4>
                        <p class="m-0 text-sm text-muted">Status: <span class="text-primary fw-semibold">{{ ucfirst($commission->status) }}</span></p>
                    </div>
                    <a href="/commission/{{ $commission->id }}" class="btn btn-secondary py-1 px-2 text-sm">View Details</a>
                </div>
            @endforeach
        @else
            <div class="text-muted py-3 text-center">You have no commissions yet.</div>
        @endif
    </div>
</div>
@endsection