@extends('layouts.app')
@section('title', 'Create Agreement')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="dashboard-title text-center">Create Agreement</div>
    <form action="/agreement/create/{{ $commission->id }}" method="POST" class="commission-form p-0 border-none b-transparent">
        @csrf
        <div class="form-group">
            <label for="agreement">Agreement Text</label>
            <textarea id="agreement" name="agreement" rows="10" placeholder="Specify project terms, rights, and timeline..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-full py-2">Publish Agreement</button>
    </form>
</div>
@endsection