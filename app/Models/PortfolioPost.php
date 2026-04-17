<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
        'estimated_price',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
