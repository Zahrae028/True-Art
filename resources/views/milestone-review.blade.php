@extends('layouts.app')
@section('title', 'Milestone Review')
@section('content')
<div class="dashboard-section mx-auto" style="max-width: 600px; margin-top: 3rem !important;">
    <div class="dashboard-title text-center">Milestone Review</div>
    <div class="dashboard-content">
        <p class="text-center text-dim mb-4">Review the latest submission and decide the next step for this milestone.</p>
        <div class="box-accent mb-4 p-3">
            <div class="mb-1"><span class="text-dim">Milestone:</span> <span class="fw-semibold text-main">{{ $milestone->title }}</span></div>
            <div class="mb-1 text-sm text-muted">{{ $milestone->description }}</div>
            <div><span class="text-dim">Status:</span> <span class="text-primary fw-bold text-uppercase text-xs">{{ $milestone->status }}</span></div>
        </div>
        <div class="d-flex gap-2">
            <form action="/milestone/{{ $milestone->id }}/approve" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="btn btn-primary w-full py-2">Approve Delivery</button>
            </form>
            <form action="/milestone/{{ $milestone->id }}/reject" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="btn btn-secondary w-full py-2" style="border-color: var(--accent); color: var(--accent);">Request Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection