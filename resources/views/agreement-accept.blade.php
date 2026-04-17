@extends('layouts.app')
@section('title', 'Accept Agreement')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Commission Agreement</div>
    <div class="dashboard-content">
        <p>Please review and accept the agreement to proceed with your commission.</p>
        <form action="/agreement/accept/{{ $commission->id }}" method="POST">
            @csrf
            <textarea readonly class="commission-form" style="margin-bottom:1rem;">{{ $agreement->text }}</textarea>
            <button type="submit" class="btn btn-primary">Accept Agreement</button>
        </form>
    </div>
</div>
@endsection