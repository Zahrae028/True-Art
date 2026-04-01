<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
      'commission_id',
      'sender_id',
      'content',
    ];
}
