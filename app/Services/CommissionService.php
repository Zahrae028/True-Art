<?php

namespace App\Services;

use App\Models\Commission;

class CommissionService
{
    public function create($data, $user)
    {
        return Commission::create([
            'client_id' => $user->id,
            'artist_id' => $data['artist_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => 'pending',
        ]);
    }

    public function accept($commission)
    {
        $commission->status = 'accepted';
        $commission->save();
    }

     public function pay($commission)
    {
        if ($commission->status !== 'milestone_approved') {
            return "Cannot pay yet";
        }

        $commission->status = 'paid';
        $commission->save();
    }
    public function complete($commission)
    {
        if ($commission->status !== 'paid') {
            return "Not paid yet";
        }

        $commission->status = 'completed';
        $commission->save();
    }
}