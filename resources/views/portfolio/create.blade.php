@extends('layouts.app')

@section('title', 'Add to Portfolio')

@section('content')
<div class="dashboard-section mx-auto max-w-lg mt-lg">
    <div class="dashboard-title">Showcase Your Work</div>
    <p class="text-dim mb-4">Upload your best artwork to show clients your specialized abilities and current pricing.</p>

    <div class="dashboard-content">
        <form action="/portfolio" method="POST" enctype="multipart/form-data" class="commission-form p-0 border-none b-transparent">
            @csrf
            
            <div class="d-grid gap-3 mb-4 grid-2-cols">
                <div class="form-group mb-0">
                    <label>Artwork Image</label>
                    <div id="upload-zone" class="relative rounded overflow-hidden d-flex flex-column items-center justify-center transition-all cursor-pointer bg-primary-tiny h-380" 
                         style="border: 2px dashed var(--border);" 
                         onclick="document.getElementById('image-input').click()">
                        <div id="placeholder-text" class="text-center">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" class="mb-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <div class="fw-bold text-main">Click to Upload Art</div>
                            <div class="text-xs text-dim">Recommended: 1200x800px or larger</div>
                        </div>
                        <img id="image-preview" src="#" class="h-full w-full d-none object-cover">
                        <input type="file" id="image-input" name="image" accept="image/*" class="d-none" onchange="previewArt(event)" required>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2">
                    <div class="form-group">
                        <label for="title">Work Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g., Cyberpunk Street Illustration" required>
                    </div>

                    <div class="form-group">
                        <label for="estimated_price">Starting Price ($)</label>
                        <input type="number" id="estimated_price" name="estimated_price" placeholder="e.g., 150" step="0.01">
                        <span class="text-xs text-dim mt-1 d-block">Helps clients understand your pricing tier.</span>
                    </div>

                    <div class="form-group mb-0">
                        <label for="description">Process Context (Optional)</label>
                        <textarea id="description" name="description" rows="6" placeholder="Describe the style, time taken, or software used..."></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="/dashboard/artist" class="btn btn-secondary flex-1">Cancel</a>
                <button type="submit" class="btn btn-primary" style="flex: 2;">Publish to My Portfolio</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewArt(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('image-preview');
        const placeholder = document.getElementById('placeholder-text');
        output.src = reader.result;
        output.classList.remove('d-none');
        placeholder.classList.add('d-none');
        document.getElementById('upload-zone').style.borderColor = 'var(--primary)';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
