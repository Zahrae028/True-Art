@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<div class="dashboard-section" style="max-width: 600px; margin: 0 auto;">
    <div class="dashboard-title">My Profile</div>
    <div class="dashboard-content">
        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="commission-form" style="background: transparent; border: none; padding: 0;">
            @csrf
            
            <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 2rem;">
                <img id="avatar-preview" src="{{ $user->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $user->email }}" 
                     style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3.5px solid var(--primary); margin-bottom: 1rem; box-shadow: 0 0 20px var(--primary-glow);" alt="">
                <label for="avatar" style="cursor: pointer; color: var(--primary); font-family: var(--font-heading); font-weight: 700;">Change Picture</label>
                <input type="file" id="avatar" name="avatar" accept="image/*" style="display: none;" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            
            <div class="form-group">
                <label for="bio">Personal Bio</label>
                <textarea id="bio" name="bio" rows="4" placeholder="Briefly describe your interest in art..." required>{{ $user->profile->bio ?? '' }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Update My Profile</button>
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