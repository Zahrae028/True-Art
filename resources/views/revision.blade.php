@extends('layouts.app')
@section('title', 'Revision Handling')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Revision Handling</div>
    <div class="dashboard-content">
        <p>Handle revision requests for this milestone.</p>
        <form action="/milestone/{{ $milestone->id }}/revision" method="POST" class="commission-form">
            @csrf
            <label for="revision">Revision Notes</label>
            <textarea id="revision" name="revision" required></textarea>
            <button type="submit" class="btn btn-primary">Submit Revision</button>
        </form>
    </div>
</div>
@endsection