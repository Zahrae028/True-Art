@extends('layouts.app')
@section('title', 'Revision Handling')
@section('content')
<div class="dashboard-section mx-auto" style="max-width: 600px; margin-top: 3rem !important;">
    <div class="dashboard-title text-center">Revision Handling</div>
    <div class="dashboard-content">
        <p class="text-center text-dim mb-3">Outline the specific changes required for this milestone.</p>
        <form action="/milestone/{{ $milestone->id }}/revision" method="POST" class="commission-form p-0 border-none b-transparent" style="background: transparent;">
            @csrf
            <div class="form-group">
                <label for="revision">Revision Notes</label>
                <textarea id="revision" name="revision" rows="6" placeholder="Be as detailed as possible to help the artist..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-full py-2">Submit Revision Request</button>
        </form>
    </div>
</div>
@endsection