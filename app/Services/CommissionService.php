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

    public function payDeposit($commission)
    {
        if ($commission->status !== 'accepted') {
            return "Commission must be accepted before paying the deposit.";
        }

        $commission->status = 'deposit_paid';
        $commission->paid_amount = $commission->getDepositAmount();
        $commission->deposit_paid_at = now();
        $commission->save();
    }

    public function refundDeposit($commission)
    {
        if ($commission->status !== 'deposit_paid') {
            return "No deposit to refund at this stage.";
        }

        if (!$commission->isRefundable()) {
            return "The 48-hour refund window has expired.";
        }

        $commission->status = 'cancelled';
        $commission->paid_amount = 0;
        $commission->deposit_paid_at = null;
        $commission->save();
    }

    public function payFinal($commission)
    {
        if ($commission->status !== 'deposit_paid') {
            return "Deposit must be paid before final payment.";
        }

        $commission->status = 'paid';
        $commission->paid_amount = $commission->price;
        $commission->save();
    }

    public function complete($commission)
    {
        if ($commission->status !== 'paid') {
            return "Final payment must be received before marking as complete.";
        }

        $commission->status = 'completed';
        $commission->save();
    }
}