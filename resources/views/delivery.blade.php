@extends('layouts.app')
@section('title', 'Project Preview')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="dashboard-title text-center">Project Preview</div>
    <div class="dashboard-content text-center">
        <p class="text-dim mb-4">Your commission is active! Review the latest milestones below.</p>
        <div class="box-accent mb-4 text-left">
            <div class="mb-1"><span class="text-dim">Project:</span> <span class="fw-semibold text-main">{{ $commission->title }}</span></div>
            <div><span class="text-dim">Artist:</span> <span class="fw-semibold text-primary">{{ $commission->artist->name }}</span></div>
        </div>
        <a href="/commission/{{ $commission->id }}" class="btn btn-secondary w-full py-2">
            Back to Dashboard
        </a>
    </div>
</div>
@endsection