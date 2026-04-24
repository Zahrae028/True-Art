@extends('layouts.app')

@section('content')
<div class="dashboard-section p-3">
    <div class="dashboard-title text-xl">Dashboard</div>
    <div class="dashboard-content">
        <div class="dashboard-section box-accent border-dashed border-primary" style="background: rgba(139, 92, 246, 0.05);">
            <h3 class="dashboard-title text-lg">Create a New Commission</h3>
            <form action="/commission" method="POST" class="commission-form p-0 border-none b-transparent w-full" style="background: transparent; border: none;">
                @csrf
                <div class="d-flex gap-3">
                    <div class="form-group flex-1">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Character Design, Portrait, etc." required>
                    </div>
                    <div class="form-group flex-1">
                        <label for="artist_id">Artist ID</label>
                        <input type="number" id="artist_id" name="artist_id" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="Tell the artist about your vision..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary py-2 px-4">Create Commission</button>
            </form>
        </div>

        <h3 class="dashboard-title text-xl mt-5">My Commissions</h3>
        <div class="d-flex flex-column gap-2">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section mb-0 d-flex items-center justify-between p-3">
                        <div>
                            <h4 class="m-0 font-heading text-lg text-main">{{ $commission->title }}</h4>
                            <div class="text-xs text-muted mt-1">
                                Status: <span class="text-primary fw-semibold">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-2 items-center">
                            @if($commission->status === 'accepted')
                                <form action="/commission/{{ $commission->id }}/pay" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary py-1 px-2 text-xs">Pay Deposit</button>
                                </form>
                            @endif
                            <a href="/commission/{{ $commission->id }}" class="btn btn-primary py-1 px-3 text-xs">Details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section text-center p-4 border-dotted text-dim">
                    You have no commissions yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
