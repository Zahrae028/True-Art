<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'commission_id',
        'title',
        'status',
        'file',
    ];

    public function commission()
{
    return $this->belongsTo(Commission::class);
}
}
