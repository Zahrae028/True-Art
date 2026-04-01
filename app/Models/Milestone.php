<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'comission',
        'title',
        'status',
        'file',
    ];

    public function commission()
{
    return $this->belongsTo(Commission::class);
}
}
