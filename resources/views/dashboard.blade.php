@extends('layouts.app')

@section('content')
<div class="dashboard-section">
    <div class="dashboard-title">Dashboard</div>
    <div class="dashboard-content">
        <div class="dashboard-section" style="border-style: dashed; border-color: var(--primary); background: rgba(139, 92, 246, 0.05);">
            <h3 class="dashboard-title" style="font-size: 1.25rem;">Create a New Commission</h3>
            <form action="/commission" method="POST" class="commission-form" style="max-width: 100%; padding: 0; background: transparent; border: none;">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" placeholder="Character Design, Portrait, etc." required>
                    </div>
                    <div class="form-group">
                        <label for="artist_id">Artist ID</label>
                        <input type="number" id="artist_id" name="artist_id" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="Tell the artist about your vision..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Commission</button>
            </form>
        </div>

        <h3 class="dashboard-title" style="font-size: 1.5rem; margin-top: 3rem;">My Commissions</h3>
        <div style="display: grid; gap: 1rem;">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    <div class="dashboard-section" style="margin-bottom: 0; display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 2rem;">
                        <div>
                            <h4 style="margin: 0; font-family: var(--font-heading); font-size: 1.1rem; color: var(--text-main);">{{ $commission->title }}</h4>
                            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">
                                Status: <span style="color: var(--primary); font-weight: 600;">{{ ucfirst($commission->status) }}</span>
                            </div>
                        </div>
                        <div style="display: flex; gap: 0.75rem; align-items: center;">
                            @if($commission->status === 'pending')
                                <form action="/commission/{{ $commission->id }}/accept" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Accept</button>
                                </form>
                                <form action="/commission/{{ $commission->id }}/pay" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Pay</button>
                                </form>
                            @endif
                            <a href="/commission/{{ $commission->id }}" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Details</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="dashboard-section" style="text-align: center; border-style: dotted; color: var(--text-dim);">
                    You have no commissions yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
