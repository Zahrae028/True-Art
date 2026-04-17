@extends('layouts.app')

@section('title', 'Commission Details')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 350px; gap: 2rem; align-items: start;">
    
    <!-- Left Column: Details & Milestones -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Commission Header -->
        <div class="dashboard-section">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1.5rem;">
                <div>
                    <h1 class="dashboard-title" style="margin-bottom: 0.5rem;">{{ $commission->title }}</h1>
                    <div style="display: flex; gap: 1rem; color: var(--text-dim); font-size: 0.9rem;">
                        <span>ID: #{{ $commission->id }}</span>
                        <span>•</span>
                        <span>Status: <span style="color: var(--primary); font-weight: 600;">{{ ucfirst($commission->status) }}</span></span>
                    </div>
                </div>
                <div style="text-align: right;">
                    <!-- Artist Actions: Quote Price -->
                    @if(auth()->id() === $commission->artist_id && $commission->status === 'pending')
                        <div style="background: rgba(139, 92, 246, 0.05); padding: 1rem; border-radius: var(--radius-sm); border: 1px dashed var(--primary);">
                            <div style="font-size: 0.75rem; color: var(--text-dim); margin-bottom: 0.5rem; text-transform: uppercase; font-weight: 700;">Set Quote Price</div>
                            <form action="/commission/{{ $commission->id }}/accept" method="POST" style="display: flex; gap: 0.5rem;">
                                @csrf
                                <div style="position: relative; flex: 1;">
                                    <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: var(--text-dim);">$</span>
                                    <input type="number" name="price" placeholder="0.00" step="0.01" min="0" required 
                                           style="padding: 0.5rem 0.5rem 0.5rem 1.75rem; font-size: 0.85rem; width: 100%;">
                                </div>
                                <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">Submit Quote</button>
                            </form>
                        </div>
                    @endif

                    <!-- Client Actions: Approve/Decline Quote -->
                    @if(auth()->id() === $commission->client_id && $commission->status === 'quoted')
                        <div style="display: flex; gap: 0.5rem; flex-direction: column;">
                            <form action="/commission/{{ $commission->id }}/approve-quote" method="POST" style="margin-bottom: 0;">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="background: #22c55e; border-color: #22c55e; width: 100%;">Approve ${{ number_format($commission->price, 2) }} Quote</button>
                            </form>
                            <form action="/commission/{{ $commission->id }}/decline-quote" method="POST" style="margin-bottom: 0;">
                                @csrf
                                <button type="submit" class="btn btn-secondary" style="width: 100%; border-color: #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.05);">Decline & Cancel</button>
                            </form>
                        </div>
                    @endif

                    <!-- Client Actions: Withdraw Pending Request -->
                    @if(auth()->id() === $commission->client_id && $commission->status === 'pending')
                        <form action="/commission/{{ $commission->id }}/decline-quote" method="POST" style="margin-bottom: 1rem;">
                            @csrf
                            <button type="submit" class="btn btn-secondary" style="width: 100%; border-color: #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.05);">Withdraw Request</button>
                        </form>
                    @endif

                    <!-- Wait Message for Artist -->
                    @if(auth()->id() === $commission->artist_id && $commission->status === 'quoted')
                        <div style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-size: 0.85rem; font-weight: 600; border: 1px solid rgba(59, 130, 246, 0.2);">
                            Awaiting Client Approval of ${{ number_format($commission->price, 2) }} Quote
                        </div>
                    @endif

                    <!-- Price Display for Other States -->
                    @if(in_array($commission->status, ['accepted', 'paid', 'completed']) && $commission->price)
                        <div style="margin-bottom: 1rem;">
                            <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase;">Agreed Price</div>
                            <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">${{ number_format($commission->price, 2) }}</div>
                        </div>
                    @endif

                    @if(auth()->id() === $commission->client_id && $commission->status === 'accepted')
                        <form action="/commission/{{ $commission->id }}/pay" method="POST" style="margin-bottom: 1rem;">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="background: #3b82f6; border-color: #3b82f6; width: 100%;">Pay for Commission</button>
                        </form>
                    @endif

                    @if(auth()->id() === $commission->artist_id && $commission->status === 'accepted')
                        <form action="/commission/{{ $commission->id }}/complete" method="POST" style="margin-bottom: 1rem;">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="background: #a855f7; border-color: #a855f7; width: 100%;">Mark as Complete</button>
                        </form>
                    @endif
                    <div style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 0.25rem;">Artist</div>
                    <div style="font-weight: 600; color: var(--text-main);">{{ $commission->artist->name }}</div>
                </div>
            </div>
            <div class="dashboard-content" style="line-height: 1.8;">
                {{ $commission->description }}
            </div>
        </div>

        <!-- Milestones Section -->
        <div class="dashboard-section">
            <h2 class="dashboard-title" style="font-size: 1.5rem;">Workflow Milestones</h2>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                @if(isset($commission->milestones) && count($commission->milestones) > 0)
                    @foreach($commission->milestones as $milestone)
                        <div style="background: var(--bg-main); border: 1px solid var(--border); border-radius: var(--radius-sm); overflow: hidden; display: flex; flex-direction: column;">
                            @if($milestone->file)
                                <div style="height: 200px; width: 100%; background: #000; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                    <img src="{{ asset($milestone->file) }}" alt="{{ $milestone->title }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            @endif
                            
                            <div style="padding: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <div style="font-weight: 600; color: var(--text-main); margin-bottom: 0.25rem;">{{ $milestone->title }}</div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">
                                        Status: <span style="color: var(--primary);">{{ ucfirst($milestone->status) }}</span>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    @if(auth()->id() === $commission->client_id && $milestone->status === 'pending')
                                        <form action="/milestone/{{ $milestone->id }}/approve" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Approve</button>
                                        </form>
                                        <form action="/milestone/{{ $milestone->id }}/reject" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Reject</button>
                                        </form>
                                    @endif
                                    @if($milestone->file)
                                        <a href="{{ asset($milestone->file) }}" target="_blank" class="btn btn-secondary" style="padding: 0.4rem 1rem; font-size: 0.85rem;">Open Full Size</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 2rem; color: var(--text-dim); border: 1px dashed var(--border); border-radius: var(--radius-sm);">
                        No milestones have been created yet.
                    </div>
                @endif
            </div>

            @if(auth()->id() === $commission->artist_id)
                <div style="background: rgba(139, 92, 246, 0.03); border: 1px dashed var(--primary); border-radius: var(--radius-sm); padding: 1.5rem;">
                    <h3 style="font-size: 1rem; margin-bottom: 1rem; font-family: var(--font-heading);">Create New Milestone</h3>
                    <form action="/milestone" method="POST" enctype="multipart/form-data" class="form-group" style="margin-bottom: 0;">
                        @csrf
                        <input type="hidden" name="commission_id" value="{{ $commission->id }}">
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <input type="text" name="title" placeholder="e.g., Lineart, Color Pass..." required>
                            <div style="display: flex; gap: 1rem; align-items: center;">
                                <input type="file" name="image" accept="image/*" style="flex: 1; padding: 0.5rem; border-style: dashed;">
                                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">Upload Milestone</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: Sidebar / Workspace Messenger -->
    <div style="position: sticky; top: 100px;">
        <div class="inbox-wrapper" style="display: flex; flex-direction: column; height: 600px; grid-template-columns: 1fr; border-radius: var(--radius);">
            <div class="chat-thread-header" style="padding: 1rem 1.5rem;">
                <div class="chat-thread-user">
                    <div style="font-weight: 700; font-family: var(--font-heading); font-size: 0.85rem; text-transform: uppercase; color: var(--primary); letter-spacing: 0.05em;">Messenger</div>
                </div>
                <div style="font-size: 0.75rem; color: var(--text-dim);">
                    Chatting with {{ auth()->id() === $commission->client_id ? $commission->artist->name : $commission->client->name }}
                </div>
            </div>
            
            <div class="chat-thread-messages" style="padding: 1.5rem; gap: 1rem;">
                @if(isset($commission->messages) && count($commission->messages) > 0)
                    @php $lastSenderId = null; @endphp
                    @foreach($commission->messages as $message)
                        <div class="bubble-container {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}" style="gap: 0.25rem;">
                            <div style="display: flex; gap: 0.5rem; flex-direction: {{ $message->sender_id === auth()->id() ? 'row-reverse' : 'row' }};">
                                @if($message->sender_id !== $lastSenderId)
                                    <img src="{{ $message->sender->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $message->sender->email }}" 
                                         style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover; margin-top: auto;" alt="">
                                @else
                                    <div style="width: 24px;"></div>
                                @endif
                                
                                <div class="chat-bubble {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}" 
                                     style="padding: 0.6rem 1rem; font-size: 0.9rem; line-height: 1.4;">
                                    {{ $message->content }}
                                </div>
                            </div>
                        </div>
                        @php $lastSenderId = $message->sender_id; @endphp
                    @endforeach
                @else
                    <div style="margin: auto; text-align: center; color: var(--text-dim); padding: 2rem;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 1rem; opacity: 0.3;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                        <p style="font-size: 0.85rem;">No messages yet. Send a message to start communicating!</p>
                    </div>
                @endif
            </div>

            <div class="chat-input-wrapper" style="padding: 1rem 1.5rem;">
                <form action="/message" method="POST" style="display: flex; gap: 0.75rem; align-items: center;">
                    @csrf
                    <input type="hidden" name="commission_id" value="{{ $commission->id }}">
                    <input type="text" name="content" class="chat-input-field" placeholder="Aa" required style="padding: 0.6rem 1.25rem; font-size: 0.9rem;">
                    <button type="submit" class="btn btn-primary" style="height: 36px; width: 36px; border-radius: 50%; padding: 0; flex-shrink: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
