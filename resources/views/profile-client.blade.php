@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md section-adaptive-padding">
    <div class="dashboard-title">My Profile</div>
    <div class="dashboard-content">
        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="commission-form p-0 border-none b-transparent">
            @csrf
            
            <div class="d-flex flex-column items-center mb-4 text-center">
                <img id="avatar-preview" src="{{ $user->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->email }}" 
                     class="rounded-full border-primary mb-2 shadow-primary object-cover avatar-edit-sm" 
                     alt="{{ $user->name }}">
                <label for="avatar" class="cursor-pointer text-primary font-heading fw-bold py-1 px-2 border-tiny rounded-sm bg-primary-tiny hover-bg-tiny transition-all">Change Picture</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" class="d-none" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="bio">Personal Bio</label>
                <textarea id="bio" name="bio" rows="4" placeholder="Briefly describe your interest in art..." required>{{ $user->profile->bio ?? '' }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary w-full">Update My Profile</button>
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