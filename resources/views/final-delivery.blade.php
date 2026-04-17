@extends('layouts.app')
@section('title', 'Final Delivery')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 2rem auto;">
    <div class="dashboard-title">Final Delivery</div>
    <div class="dashboard-content">
        <p>Deliver the final files to your client.</p>
        <form action="/commission/{{ $commission->id }}/deliver" method="POST" enctype="multipart/form-data" class="commission-form">
            @csrf
            <label for="final_file">Upload Final Artwork</label>
            <input type="file" id="final_file" name="final_file" required>
            <button type="submit" class="btn btn-primary">Deliver</button>
        </form>
    </div>
</div>
@endsection