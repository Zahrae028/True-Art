@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="inbox-wrapper {{ isset($activeCommission) ? 'chat-open' : '' }}">
    
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
                <div class="p-4 text-center text-dim text-sm">
                    <div class="mb-2 opacity-20">
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
                    <a href="/messages" class="text-dim me-2 d-none d-block-tablet">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-top: 4px;"><polyline points="15 18 9 12 15 6"/></svg>
                    </a>
                    <img src="{{ $activeOtherUser->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $activeOtherUser->email }}" 
                         class="rounded-full w-40 h-40 object-cover border-primary" alt="">
                    <div>
                        <div class="fw-bold text-main ls-tight">{{ $activeOtherUser->name }}</div>
                        <div class="text-xs text-muted d-flex items-center gap-1">
                            <span class="rounded-full bg-success" style="width: 6px; height: 6px;"></span> Active Now
                        </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <div class="font-heading text-sm fw-bold text-primary text-uppercase ls-wide">
                        {{ $activeCommission->title }}
                    </div>
                    <a href="/commission/{{ $activeCommission->id }}" class="text-xs text-dim border-dashed-dim">View Project Details</a>
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
                    <div class="mx-auto text-center text-dim max-w-xs">
                        <div class="text-lg fw-bold text-main mb-1">New Conversation</div>
                        <p class="text-sm">Start your collaboration on <strong>{{ $activeCommission->title }}</strong> by sending a message below.</p>
                    </div>
                @endif
            </div>

            <!-- Message Input -->
            <div class="chat-input-wrapper">
                <form action="/message" method="POST" class="d-flex gap-2 items-center">
                    @csrf
                    <input type="hidden" name="commission_id" value="{{ $activeCommission->id }}">
                    <input type="text" name="content" class="chat-input-field" placeholder="Write a message to {{ $activeOtherUser->name }}..." required>
                    <button type="submit" class="btn btn-primary rounded-full p-0 flex-shrink-0 d-flex items-center justify-center" style="height: 48px; width: 48px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </form>
            </div>
        @else
            <div class="d-flex flex-column items-center justify-center h-full p-4 text-center">
                <div class="bg-primary-tiny rounded-full d-flex items-center justify-center mx-auto mb-4 border-tiny shadow-purple" style="width: 140px; height: 140px;">
                    <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </div>
                <h3 class="font-heading text-main text-3xl mb-1 ls-tight">Communicate Mastery</h3>
                <p class="mx-auto text-dim max-w-sm lh-relaxed">Select a project from your inbox to begin discussing milestones, sharing assets, and finalizing your digital commissions.</p>
                <div class="mt-4 p-2 px-3 border-tiny rounded-sm text-xs text-primary-dim bg-primary-tiny">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Ready for Collaboration
                </div>
            </div>
        @endif
    </div>

</div>
@endsection