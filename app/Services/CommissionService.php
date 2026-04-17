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

    public function accept($commission, $price)
    {
        $commission->price = $price;
        $commission->status = 'quoted';
        $commission->save();
    }

    public function approveQuote($commission)
    {
        if ($commission->status !== 'quoted') {
            return "Commission is not in a quoting state.";
        }

        $commission->status = 'accepted';
        $commission->save();
    }

    public function declineQuote($commission)
    {
        if ($commission->status !== 'quoted' && $commission->status !== 'pending') {
            return "Commission cannot be cancelled at this stage.";
        }

        $commission->status = 'cancelled';
        $commission->save();
    }

    public function pay($commission)
    {
        if ($commission->status !== 'accepted') {
            return "Cannot pay yet. Ensure the commission has been accepted by the artist.";
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