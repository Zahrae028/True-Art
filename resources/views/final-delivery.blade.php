@extends('layouts.app')
@section('title', 'Final Delivery')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="dashboard-title text-center">Final Delivery</div>
    <div class="dashboard-content">
        <p class="text-center text-dim mb-3">Deliver the final high-resolution masters to your client to complete the project.</p>
        <form action="/commission/{{ $commission->id }}/deliver" method="POST" enctype="multipart/form-data" class="commission-form p-0 border-none b-transparent">
            @csrf
            <div class="form-group">
                <label for="final_file">Upload Master Files (ZIP/PSD/JPG)</label>
                <div class="box-accent p-3 rounded-sm" style="border: 2px dashed var(--border);">
                    <input type="file" id="final_file" name="final_file" required class="w-full">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-full py-2">Deliver Project</button>
        </form>
    </div>
</div>
@endsection