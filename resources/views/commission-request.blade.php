@extends('layouts.app')
@section('title', 'Request Commission')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 2.5rem;">
        <h1 class="dashboard-title" style="margin-bottom: 0.5rem;">Request a Commission</h1>
        <p style="color: var(--text-muted);">Collaborate with <span style="color: var(--primary); font-weight: 600;">{{ $artist->name }}</span> to bring your vision to life.</p>
    </div>

    <form action="/commission" method="POST" class="commission-form" style="background: transparent; border: none; padding: 0;">
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

        <div style="background: rgba(139, 92, 246, 0.05); border-left: 3px solid var(--primary); padding: 1rem 1.25rem; margin-bottom: 2rem; border-radius: 0 var(--radius-sm) var(--radius-sm) 0;">
            <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">
                By sending this request, you'll start a conversation with the artist to discuss milestones and pricing.
            </p>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Send Commission Request</button>
    </form>
</div>
@endsection