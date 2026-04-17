@extends('layouts.app')

@section('title', 'Add to Portfolio')

@section('content')
<div class="dashboard-section" style="max-width: 800px; margin: 0 auto;">
    <div class="dashboard-title">Showcase Your Work</div>
    <p style="color: var(--text-dim); margin-bottom: 2rem;">Upload your best artwork to show clients your specialized abilities and current pricing.</p>

    <div class="dashboard-content">
        <form action="/portfolio" method="POST" enctype="multipart/form-data" class="commission-form" style="background: transparent; border: none; padding: 0;">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div class="form-group" style="height: 100%;">
                    <label>Artwork Image</label>
                    <div id="upload-zone" style="height: 300px; border: 2px dashed var(--border); border-radius: var(--radius); display: flex; flex-direction: column; align-items: center; justify-content: center; background: rgba(255,255,255,0.02); cursor: pointer; position: relative; overflow: hidden; transition: var(--transition);" onclick="document.getElementById('image-input').click()">
                        <div id="placeholder-text" style="text-align: center;">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" style="margin-bottom: 1rem;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <div style="font-weight: 700; color: var(--text-main);">Click to Upload Art</div>
                            <div style="font-size: 0.8rem; color: var(--text-dim);">Recommended: 1200x800px or larger</div>
                        </div>
                        <img id="image-preview" src="#" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                        <input type="file" id="image-input" name="image" accept="image/*" style="display: none;" onchange="previewArt(event)" required>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div class="form-group">
                        <label for="title">Work Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g., Cyberpunk Street Illustration" required>
                    </div>

                    <div class="form-group">
                        <label for="estimated_price">Estimated Starting Price ($)</label>
                        <input type="number" id="estimated_price" name="estimated_price" placeholder="e.g., 150" step="0.01">
                        <span style="font-size: 0.75rem; color: var(--text-dim);">Helps clients understand your pricing tier.</span>
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="description">Process or Context (Optional)</label>
                        <textarea id="description" name="description" rows="5" placeholder="Describe the style, time taken, or software used..."></textarea>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="/dashboard/artist" class="btn btn-secondary" style="flex: 1; text-align: center;">Cancel</a>
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
        output.style.display = 'block';
        placeholder.style.display = 'none';
        document.getElementById('upload-zone').style.border = '2px solid var(--primary)';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
