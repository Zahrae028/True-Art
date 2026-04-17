@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="inbox-wrapper">
    
    <!-- Sidebar: Conversation List -->
    <div class="inbox-sidebar">
        <div class="inbox-sidebar-header">
            Inbox
        </div>
        
        <div class="conversation-list">
            @if(isset($commissions) && count($commissions) > 0)
                @foreach($commissions as $commission)
                    @php 
                        $otherUser = (auth()->id() === $commission->client_id) ? $commission->artist : $commission->client;
                        $isActive = isset($activeCommission) && $activeCommission->id === $commission->id;
                    @endphp
                    <a href="/messages?id={{ $commission->id }}" class="conversation-item {{ $isActive ? 'active' : '' }}">
                        <img src="{{ $otherUser->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $otherUser->email }}" 
                             class="conversation-avatar" alt="">
                        <div class="conversation-info">
                            <div class="conversation-name">{{ $otherUser->name }}</div>
                            <div class="conversation-project">{{ $commission->title }}</div>
                        </div>
                    </a>
                @endforeach
            @else
                <div style="padding: 3rem 1.5rem; text-align: center; color: var(--text-dim); font-size: 0.9rem;">
                    <div style="margin-bottom: 1rem; opacity: 0.2;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                    </div>
                    No conversations yet.
                </div>
            @endif
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="inbox-chat-area">
        @if(isset($activeCommission))
            @php 
                $activeOtherUser = (auth()->id() === $activeCommission->client_id) ? $activeCommission->artist : $activeCommission->client;
            @endphp
            <!-- Chat Header -->
            <div class="chat-thread-header">
                <div class="chat-thread-user">
                    <img src="{{ $activeOtherUser->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $activeOtherUser->email }}" 
                         style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);" alt="">
                    <div>
                        <div style="font-weight: 700; color: var(--text-main); font-size: 1.05rem; letter-spacing: -0.01em;">{{ $activeOtherUser->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.5rem;">
                            <span style="width: 6px; height: 6px; background: #22c55e; border-radius: 50%;"></span> Online
                        </div>
                    </div>
                </div>
                
                <div style="text-align: right;">
                    <div style="font-family: var(--font-heading); font-size: 0.85rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em;">
                        {{ $activeCommission->title }}
                    </div>
                    <a href="/commission/{{ $activeCommission->id }}" style="font-size: 0.75rem; color: var(--text-dim); text-decoration: none; border-bottom: 1px dashed var(--text-dim);">View Project Details</a>
                </div>
            </div>

            <!-- Messages Thread -->
            <div class="chat-thread-messages">
                @if(count($messages) > 0)
                    @foreach($messages as $message)
                        <div class="bubble-container {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                            <div class="chat-bubble {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                                {{ $message->content }}
                            </div>
                            <div class="bubble-meta">
                                {{ $message->created_at->format('H:i') }} • {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="margin: auto; text-align: center; color: var(--text-dim); max-width: 300px;">
                        <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 0.5rem;">New Conversation</div>
                        <p style="font-size: 0.9rem;">Start your collaboration on <strong>{{ $activeCommission->title }}</strong> by sending a message below.</p>
                    </div>
                @endif
            </div>

            <!-- Message Input -->
            <div class="chat-input-wrapper">
                <form action="/message" method="POST" style="display: flex; gap: 1rem; align-items: center;">
                    @csrf
                    <input type="hidden" name="commission_id" value="{{ $activeCommission->id }}">
                    <input type="text" name="content" class="chat-input-field" placeholder="Write a message to {{ $activeOtherUser->name }}..." required>
                    <button type="submit" class="btn btn-primary" style="height: 48px; width: 48px; border-radius: 50%; padding: 0; flex-shrink: 0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </form>
            </div>
        @else
            <div style="margin: auto; text-align: center; padding: 3rem;">
                <div style="width: 120px; height: 120px; background: rgba(139, 92, 246, 0.05); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; border: 1px solid rgba(139, 92, 246, 0.1);">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </div>
                <h3 style="font-family: var(--font-heading); color: var(--text-main); font-size: 1.75rem; margin-bottom: 0.75rem;">Your Creative Hub</h3>
                <p style="max-width: 400px; margin: 0 auto; color: var(--text-muted); line-height: 1.6;">Select a project from the sidebar to manage your communications, share feedback, and finalize your art commissions.</p>
            </div>
        @endif
    </div>

</div>
@endsection