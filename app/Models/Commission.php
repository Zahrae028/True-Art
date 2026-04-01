<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'client_id',
        'artist_id',
        'title',
        'description',
        'status',
    ];

    public function client(){
        return $this->belongsTo(User::class , 'client_id');
    }

    public function artist(){
        return $this->belongsTo(User::class , 'artist_id');
    }

    public function milestone(){
        return $this->hasMany(Milestone::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
