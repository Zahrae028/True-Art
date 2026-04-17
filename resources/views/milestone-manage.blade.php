@extends('layouts.app')
@section('title', 'Milestone Management')
@section('content')
<div class="dashboard-section" style="max-width: 700px; margin: 2rem auto;">
    <div class="dashboard-title">Milestone Management</div>
    <div class="dashboard-content">
        <h3>Milestones</h3>
        @if(isset($milestones) && count($milestones) > 0)
            @foreach($milestones as $milestone)
                <div class="artist-card" style="margin-bottom: 10px;">
                    <h4>{{ $milestone->title }}</h4>
                    <p>Status: {{ ucfirst($milestone->status) }}</p>
                    <form action="/milestone/{{ $milestone->id }}/upload" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="submission" required>
                        <button type="submit" class="btn btn-primary">Upload Submission</button>
                    </form>
                </div>
            @endforeach
        @else
            <div style="color: var(--text-muted); padding: 1.5rem 0; text-align: center;">No milestones yet.</div>
        @endif
    </div>
</div>
@endsection