@extends('layouts.app')
@section('title', 'Final Delivery')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Final Delivery</div>
    <div class="dashboard-content">
        <p>Your commission is ready! Download your files below.</p>
        <div class="artist-card" style="margin-bottom:1.5rem;">
            <div><strong>Title:</strong> {{ $commission->title }}</div>
            <div><strong>Artist:</strong> {{ $commission->artist->name }}</div>
        </div>
        <a href="{{ $commission->final_file_url }}" class="btn btn-primary" download>Download Artwork</a>
    </div>
</div>
@endsection