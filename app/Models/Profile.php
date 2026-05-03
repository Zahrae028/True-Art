<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   protected $fillable = [
        'user_id',
        'bio',
        'specialty',
        'portfolio',
        'avatar',
    ];
 
}
