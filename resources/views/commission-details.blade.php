@extends('layouts.app')

@section('title', 'Commission Details')

@section('content')
<div class="grid-workspace">
    
    <!-- Left Column: Details & Milestones -->
    <div class="d-flex flex-column gap-3">
        
        <!-- Commission Header -->
        <div class="dashboard-section section-adaptive-padding">
            <div class="d-flex justify-between items-start mb-3 flex-col-mobile gap-2">
                <div>
                    <h1 class="dashboard-title mb-1 text-2xl">{{ $commission->title }}</h1>
                    <div class="d-flex gap-2 text-dim text-sm flex-wrap">
                        <span>ID: #{{ $commission->id }}</span>
                        <span class="d-none-mobile">•</span>
                        <span>Status: <span class="text-primary fw-semibold">{{ ucfirst($commission->status) }}</span></span>
                    </div>
                </div>
                <div class="text-right text-left-mobile w-full-mobile">
                    <!-- Artist Actions: Quote Price -->
                    @if(auth()->id() === $commission->artist_id && $commission->status === 'pending')
                        <div class="box-accent">
                            <div class="text-xs text-dim mb-1 text-uppercase fw-bold ls-wide">Set Quote Price</div>
                            <form action="/commission/{{ $commission->id }}/accept" method="POST" class="d-flex gap-1 flex-col-mobile">
                                @csrf
                                <div class="input-with-icon flex-1">
                                    <span class="input-icon">$</span>
                                    <input type="number" name="price" placeholder="0.00" step="0.01" min="0" required class="w-full">
                                </div>
                                <button type="submit" class="btn btn-primary py-1 px-2 text-sm">Submit Quote</button>
                            </form>
                        </div>
                    @endif

                    <!-- Client Actions: Approve/Decline Quote -->
                    @if(auth()->id() === $commission->client_id && $commission->status === 'quoted')
                        <div class="d-flex gap-1 flex-column">
                            <form action="/commission/{{ $commission->id }}/approve-quote" method="POST" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full" style="background: #22c55e; border-color: #22c55e;">Approve ${{ number_format($commission->price, 2) }} Quote</button>
                            </form>
                            <form action="/commission/{{ $commission->id }}/decline-quote" method="POST" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-secondary w-full" style="border-color: #ef4444; color: #ef4444; background: rgba(239, 68, 68, 0.05);">Decline & Cancel</button>
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
                        <div class="box-info">
                            Awaiting Client Approval of ${{ number_format($commission->price, 2) }} Quote
                        </div>
                    @endif

                    <!-- Price Display for Other States -->
                    @if(in_array($commission->status, ['accepted', 'paid', 'completed']) && $commission->price)
                        <div class="mb-2">
                            <div class="text-xs text-muted text-uppercase">Agreed Price</div>
                            <div class="text-2xl fw-black text-primary">${{ number_format($commission->price, 2) }}</div>
                        </div>
                    @endif

                    @if(auth()->id() === $commission->client_id && $commission->status === 'accepted')
                        <form action="/commission/{{ $commission->id }}/pay" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary w-full bg-blue-500 border-none">Pay for Commission</button>
                        </form>
                    @endif

                    @if(auth()->id() === $commission->artist_id && $commission->status === 'accepted')
                        <form action="/commission/{{ $commission->id }}/complete" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-primary w-full bg-purple-500 border-none">Mark as Complete</button>
                        </form>
                    @endif
                    <div class="text-dim text-xs mb-05">Artist</div>
                    <div class="fw-semibold text-main">{{ $commission->artist->name }}</div>
                </div>
            </div>
            <div class="dashboard-content lh-extra text-sm">
                {{ $commission->description }}
            </div>
        </div>

        <div class="dashboard-section section-adaptive-padding">
            <h2 class="dashboard-title text-xl">Workflow Milestones</h2>
            
            <div class="d-flex flex-column gap-2 mb-4">
                @if(isset($commission->milestones) && count($commission->milestones) > 0)
                    @foreach($commission->milestones as $milestone)
                        <div class="d-flex flex-column bg-darker border-tiny rounded-sm overflow-hidden">
                            @if($milestone->file)
                                <div class="d-flex items-center justify-center overflow-hidden bg-black" style="aspect-ratio: 16/9; width: 100%;">
                                    <img src="{{ asset($milestone->file) }}" alt="{{ $milestone->title }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                            
                            <div class="p-2 d-flex justify-between items-center flex-col-mobile items-start-mobile gap-2">
                                <div>
                                    <div class="fw-semibold text-main mb-05">{{ $milestone->title }}</div>
                                    <div class="text-xs text-dim">
                                        Status: <span class="text-primary fw-bold text-uppercase">{{ $milestone->status }}</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-3 w-full-mobile flex-col-mobile">
                                    @if(auth()->id() === $commission->client_id && $milestone->status === 'pending')
                                        <div class="d-flex gap-2 w-full">
                                            <form action="/milestone/{{ $milestone->id }}/approve" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="btn btn-primary py-2 px-3 text-sm w-full">Approve Milestone</button>
                                            </form>
                                            <form action="/milestone/{{ $milestone->id }}/reject" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" class="btn btn-secondary py-2 px-3 text-sm w-full text-error border-error">Reject</button>
                                            </form>
                                        </div>
                                    @endif
                                    @if($milestone->file)
                                        <a href="{{ asset($milestone->file) }}" target="_blank" class="btn btn-secondary py-2 px-3 text-sm w-full-mobile text-center">View Asset Details</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center p-4 text-dim rounded-sm border-dashed-dim">
                        No milestones have been created yet.
                    </div>
                @endif
            </div>

            @if(auth()->id() === $commission->artist_id)
                <div class="p-3 rounded-sm" style="background: rgba(139, 92, 246, 0.03); border: 1px dashed var(--primary);">
                    <h3 class="text-base mb-2 font-heading">Create New Milestone</h3>
                    <form action="/milestone" method="POST" enctype="multipart/form-data" class="form-group mb-0">
                        @csrf
                        <input type="hidden" name="commission_id" value="{{ $commission->id }}">
                        <div class="d-flex flex-column gap-2">
                            <input type="text" name="title" placeholder="e.g., Lineart, Color Pass..." required>
                            <div class="d-flex gap-2 items-center">
                                <input type="file" name="image" accept="image/*" class="flex-1 p-1" style="border-style: dashed;">
                                <button type="submit" class="btn btn-primary py-2 px-4">Upload Milestone</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Right Column: Sidebar / Workspace Messenger -->
    <div class="sticky top-100">
        <div class="messenger-sidebar" style="height: calc(100vh - 160px); max-height: 800px; display: flex; flex-direction: column;">
            <div class="chat-thread-header p-2">
                <div class="chat-thread-user">
                    <div class="font-heading fw-black text-xs text-uppercase text-primary ls-wide">Studio Messenger</div>
                </div>
                <div class="text-xs text-dim">
                    with {{ auth()->id() === $commission->client_id ? $commission->artist->name : $commission->client->name }}
                </div>
            </div>
            
            <div class="chat-thread-messages">
                @if(isset($commission->messages) && count($commission->messages) > 0)
                    @php $lastSenderId = null; @endphp
                    @foreach($commission->messages as $message)
                        <div class="bubble-container {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                            <div class="chat-row {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                                @if($message->sender_id !== $lastSenderId)
                                    <img src="{{ $message->sender->profile->avatar ?? 'https://i.pravatar.cc/150?u=' . $message->sender->email }}" 
                                         class="rounded-full overflow-hidden object-cover" style="width: 24px; height: 24px; margin-top: auto;" alt="">
                                @else
                                    <div style="width: 24px;"></div>
                                @endif
                                
                                <div class="chat-bubble {{ $message->sender_id === auth()->id() ? 'sent' : 'received' }}">
                                    {{ $message->content }}
                                </div>
                            </div>
                        </div>
                        @php $lastSenderId = $message->sender_id; @endphp
                    @endforeach
                @else
                    <div style="margin: auto; text-align: center; color: var(--text-dim); padding: 2rem;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 1rem; opacity: 0.3;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                        <p class="text-xs">Start the creative dialogue below.</p>
                    </div>
                @endif
            </div>

            <div class="chat-input-wrapper">
                <form action="/message" method="POST" class="d-flex gap-1 items-center">
                    @csrf
                    <input type="hidden" name="commission_id" value="{{ $commission->id }}">
                    <input type="text" name="content" class="chat-input-field" placeholder="Type a message..." required>
                    <button type="submit" class="btn btn-primary rounded-full p-0 flex-shrink-0 d-flex items-center justify-center" style="height: 42px; width: 42px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
