@extends('layouts.app')
@section('title', 'Accept Agreement')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="dashboard-title text-center">Commission Agreement</div>
    <div class="dashboard-content">
        <p class="text-center text-dim mb-3">Please review and accept the agreement to proceed with your commission.</p>
        <form action="/agreement/accept/{{ $commission->id }}" method="POST" class="p-0 border-none b-transparent">
            @csrf
            <div class="form-group">
                <textarea readonly class="rounded-sm min-h-200">{{ $agreement->text }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-full py-2">Accept Agreement</button>
        </form>
    </div>
</div>
@endsection