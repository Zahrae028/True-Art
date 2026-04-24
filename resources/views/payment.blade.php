@extends('layouts.app')
@section('title', 'Payment')
@section('content')
<div class="dashboard-section mx-auto mt-lg max-w-md">
    <div class="dashboard-title text-center">Payment Simulation</div>
    <div class="dashboard-content">
        <p class="text-center text-dim mb-3">Simulate payment for your commission below.</p>
        <form action="/commission/{{ $commission->id }}/pay" method="POST" class="commission-form p-0 border-none b-transparent">
            @csrf
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="relative">
                    <span class="absolute text-dim input-icon-left">$</span>
                    <input type="number" id="amount" name="amount" value="{{ $commission->price ?? '' }}" required class="p-left-icon">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-full py-2">Pay Now</button>
        </form>
    </div>
</div>
@endsection