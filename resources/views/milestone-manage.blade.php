@extends('layouts.app')
@section('title', 'Milestone Management')
@section('content')
<div class="dashboard-section mx-auto" style="max-width: 700px; margin-top: 3rem !important;">
    <div class="dashboard-title text-center">Milestone Management</div>
    <div class="dashboard-content">
        <h3 class="text-lg font-heading mb-3">Project Milestones</h3>
        @if(isset($milestones) && count($milestones) > 0)
            <div class="d-flex flex-column gap-2">
                @foreach($milestones as $milestone)
                    <div class="dashboard-section mb-0 p-3">
                        <div class="d-flex justify-between items-center mb-2">
                            <h4 class="m-0 fw-bold">{{ $milestone->title }}</h4>
                            <span class="text-xs fw-extrabold text-uppercase px-1 rounded-sm" style="background: rgba(139, 92, 246, 0.1); color: var(--primary);">{{ $milestone->status }}</span>
                        </div>
                        <form action="/milestone/{{ $milestone->id }}/upload" method="POST" enctype="multipart/form-data" class="d-flex gap-1 items-center">
                            @csrf
                            <input type="file" name="submission" required class="flex-1 p-1 text-xs" style="border-style: dashed;">
                            <button type="submit" class="btn btn-primary py-1 px-3 text-sm">Upload</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-5 text-dim border-dotted rounded-sm">No milestones defined for this project yet.</div>
        @endif
    </div>
</div>
@endsection