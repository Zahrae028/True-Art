@extends('layouts.app')
@section('title', 'Artist Profile Management')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md section-adaptive-padding">
    <div class="dashboard-title">Artist Profile Management</div>
    <div class="dashboard-content">
        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="commission-form p-0 border-none b-transparent">
            @csrf

            <div class="d-flex flex-column items-center mb-4 text-center">
                <img id="avatar-preview" src="{{ $user->profile?->avatar }}" 
                     class="rounded-full border-primary mb-2 shadow-primary object-cover avatar-edit-sm" 
                     alt="{{ $user->name }}">
                <label for="avatar" class="cursor-pointer text-primary font-heading fw-bold py-1 px-2 border-tiny rounded-sm bg-primary-tiny hover-bg-tiny transition-all">Change Profile Picture</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" class="d-none" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label for="name">Public Display Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="specialty">Art Specialty</label>
                <input type="text" id="specialty" name="specialty" value="{{ $user->profile->specialty ?? '' }}" placeholder="e.g., 3D Environmental Artist">
            </div>

            <div class="form-group">
                <label for="bio">Professional Bio</label>
                <textarea id="bio" name="bio" rows="6" placeholder="Tell potential clients about your experience, style, and workflow..." required>{{ $user->profile->bio ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary w-full">Save Changes</button>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('avatar-preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection