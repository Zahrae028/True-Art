<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function send($data, $user)
    {
        return Message::create([
            'commission_id' => $data['commission_id'],
            'sender_id' => $user->id,
            'content' => $data['content'],
        ]);
    }
}
