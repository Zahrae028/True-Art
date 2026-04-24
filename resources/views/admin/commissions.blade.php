@extends('layouts.app')

@section('title', 'Monitor Commissions')

@section('content')
<div class="hero-section text-left py-2">
    <h1 class="hero-title text-3xl mb-1">Project <span>Oversight</span></h1>
    <p class="hero-description m-0 text-base">Monitoring all active and completed art commissions across the platform.</p>
</div>

<div class="dashboard-section p-0 overflow-hidden">
    <table class="w-full text-left collapse">
        <thead>
            <tr class="border-bottom bg-tiny">
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Project Title</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Collaborators</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Current Status</th>
                <th class="p-3 font-heading text-xs text-uppercase ls-wide text-dim">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commissions as $commission)
            <tr class="transition-all border-tiny border-none hover-bg-tiny" style="border-left: none; border-right: none; border-top: none;">
                <td class="p-3">
                    <div class="fw-bold text-main text-base">{{ $commission->title }}</div>
                    <div class="text-xs text-dim mt-1">Initiated {{ $commission->created_at->diffForHumans() }}</div>
                </td>
                <td class="p-3">
                    <div class="text-sm text-muted">
                        <span class="text-main fw-semibold">{{ $commission->client->name }}</span>
                        <span class="mx-1 opacity-40">&rarr;</span>
                        <span class="text-primary fw-semibold">{{ $commission->artist->name }}</span>
                    </div>
                </td>
                <td class="p-3">
                    <span class="d-inline p-1 rounded-sm text-xs fw-extrabold text-uppercase 
                        {{ $commission->status === 'completed' ? 'bg-success-tiny text-success-bright' : 
                          ($commission->status === 'paid' ? 'bg-info-tiny text-info' : 
                          ($commission->status === 'pending' ? 'bg-warning-tiny text-warning' : 'bg-primary-tiny text-primary')) }}">
                        {{ $commission->status }}
                    </span>
                </td>
                <td class="p-3">
                    <a href="/commission/{{ $commission->id }}" class="btn btn-secondary py-1 px-2 text-xs">View Project</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
