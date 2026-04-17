<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Services\MessageService;

class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function send(Request $request)
    {
        $commission = Commission::findOrFail($request->commission_id);
        
        $receiverId = ($commission->client_id === auth()->id()) 
            ? $commission->artist_id 
            : $commission->client_id;

        $data = $request->all();
        $data['receiver_id'] = $receiverId;

        $this->messageService->send($data, auth()->user());

        return back();
    }
}