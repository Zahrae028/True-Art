@extends('layouts.app')
@section('title', 'Payment')
@section('content')
<div class="dashboard-section" style="max-width: 500px; margin: 2rem auto;">
    <div class="dashboard-title">Payment Simulation</div>
    <div class="dashboard-content">
        <p>Simulate payment for your commission below.</p>
        <form action="/commission/{{ $commission->id }}/pay" method="POST" class="commission-form">
            @csrf
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" value="{{ $commission->price ?? '' }}" required>
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</div>
@endsection