@extends('layouts.app')
@section('title', 'Request Commission')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="text-center mb-4">
        <h1 class="dashboard-title mb-1">Request a Commission</h1>
        <p class="text-muted">Collaborate with <span class="text-primary fw-semibold">{{ $artist->name }}</span> to bring your vision to life.</p>
    </div>

    <form action="/commission" method="POST" class="commission-form p-0 border-none b-transparent">
        @csrf
        <input type="hidden" name="artist_id" value="{{ $artist->id }}">
        
        <div class="form-group">
            <label for="title">Project Title</label>
            <input type="text" id="title" name="title" placeholder="e.g., Full-Body Character Illustration" required>
        </div>

        <div class="form-group">
            <label for="description">Detailed Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Describe your characters, background, mood, and any specific requirements..." required></textarea>
        </div>

        <div class="box-accent border-left-accent bg-primary-tiny p-2 mb-4 rounded-right-sm">
            <p class="text-xs text-muted m-0">
                By sending this request, you'll start a conversation with the artist to discuss milestones and pricing.
            </p>
        </div>

        <button type="submit" class="btn btn-primary w-full p-1">Send Commission Request</button>
    </form>
</div>
@endsection