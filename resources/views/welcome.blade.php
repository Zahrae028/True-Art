@extends('layouts.app')

@section('title', 'TrueArt - High-End Digital Commissions')

@section('content')
<div class="hero-section text-center py-5">
    <h1 class="hero-title text-4xl mb-2">TrueArt <span>Mastery</span></h1>
    <p class="hero-description mx-auto text-xl mb-4 max-w-md">
        The premier destination for world-class digital art commissions. Connect with elite artists and bring your vision to life through a secure, milestone-based workflow.
    </p>
    <div class="d-flex gap-2 justify-center">
        <a href="/explore" class="btn btn-primary px-4 py-2">Explore the Showcase</a>
        <a href="/artists" class="btn btn-secondary px-4 py-2">Find an Artist</a>
    </div>
</div>

<div class="grid-showcase mt-5">
    <div class="dashboard-section text-center p-4">
        <div class="box-accent rounded-full w-40 h-40 d-flex items-center justify-center mx-auto mb-3 bg-primary-tiny">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3 class="font-heading text-lg fw-bold text-main mb-1">Secure Collaboration</h3>
        <p class="text-sm text-dim">Milestone-based payments ensure your funds are only released when you approve the artwork.</p>
    </div>
    
    <div class="dashboard-section text-center p-4">
        <div class="box-accent rounded-full w-40 h-40 d-flex items-center justify-center mx-auto mb-3 bg-primary-tiny">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <h3 class="font-heading text-lg fw-bold text-main mb-1">Direct Communication</h3>
        <p class="text-sm text-dim">Talk directly with your artist in our real-time studio workspace for seamless feedback.</p>
    </div>

    <div class="dashboard-section text-center p-4">
        <div class="box-accent rounded-full w-40 h-40 d-flex items-center justify-center mx-auto mb-3 bg-primary-tiny">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l9.78-9.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3 class="font-heading text-lg fw-bold text-main mb-1">Original Quality</h3>
        <p class="text-sm text-dim">Every piece on TrueArt is verified for quality and originality by our master artist community.</p>
    </div>
</div>

<div class="dashboard-section mt-5 p-5 text-center box-accent">
    <h2 class="dashboard-title text-2xl mb-1">Ready to create something <span>extraordinary?</span></h2>
    <p class="text-muted mb-4">Join our community of elite collectors and visionary artists today.</p>
    <div class="d-flex gap-2 justify-center">
        <a href="/register" class="btn btn-primary px-4 py-2">Create an Account</a>
        <a href="/login" class="btn btn-secondary px-4 py-2">Login to Workspace</a>
    </div>
</div>
@endsection
