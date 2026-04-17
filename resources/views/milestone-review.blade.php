@extends('layouts.app')
@section('title', 'Milestone Review')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Milestone Review</div>
    <div class="dashboard-content">
        <p>Review the submitted milestone and approve or request changes.</p>
        <div class="artist-card" style="margin-bottom:1.5rem;">
            <div><strong>Title:</strong> {{ $milestone->title }}</div>
            <div><strong>Description:</strong> {{ $milestone->description }}</div>
            <div><strong>Status:</strong> {{ ucfirst($milestone->status) }}</div>
        </div>
        <form action="/milestone/{{ $milestone->id }}/approve" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Approve</button>
        </form>
        <form action="/milestone/{{ $milestone->id }}/reject" method="POST" style="display:inline; margin-left:1rem;">
            @csrf
            <button type="submit" class="btn btn-secondary">Request Changes</button>
        </form>
    </div>
</div>
@endsection