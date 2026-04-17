@extends('layouts.app')
@section('title', 'Client Dashboard')
@section('content')
<div class="dashboard-section" style="max-width: 900px; margin: 2rem auto;">
    <div class="dashboard-title">Client Dashboard</div>
    <div class="dashboard-content">
        <a href="/commission/request" class="btn btn-primary" style="margin-bottom:2rem;">Request New Commission</a>
        <h3 style="margin-top:2rem;">My Commissions</h3>
        @if(isset($commissions) && count($commissions) > 0)
            @foreach($commissions as $commission)
                <div class="artist-card" style="margin-bottom: 10px;">
                    <h4>{{ $commission->title }}</h4>
                    <p>Status: {{ ucfirst($commission->status) }}</p>
                    <a href="/commission/{{ $commission->id }}" class="btn btn-secondary">View Details</a>
                </div>
            @endforeach
        @else
            <div style="color: var(--text-muted); padding: 1.5rem 0; text-align: center;">You have no commissions yet.</div>
        @endif
    </div>
</div>
@endsection