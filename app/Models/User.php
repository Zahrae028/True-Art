<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_banned',
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function commissionsAsClient(){
        return $this->hasMany(Commission::class , 'client_id');
    }

    public function commissionsAsArtist(){
        return $this->hasMany(Commission::class, 'artist_id');
    }

    public function portfolioPosts(){
        return $this->hasMany(PortfolioPost::class, 'user_id');
    }

}
