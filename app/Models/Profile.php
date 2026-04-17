<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   protected $fillable = [
        'user_id',
        'bio',
        'specialty',
        'projects_completed',
        'rating',
        'response_rate',
        'portfolio',
        'avatar',
    ];
 
}
