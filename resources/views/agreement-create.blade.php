@extends('layouts.app')
@section('title', 'Create Agreement')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Create Agreement</div>
    <form action="/agreement/create/{{ $commission->id }}" method="POST" class="commission-form">
        @csrf
        <label for="agreement">Agreement Text</label>
        <textarea id="agreement" name="agreement" required></textarea>
        <button type="submit" class="btn btn-primary">Send Agreement</button>
    </form>
</div>
@endsection