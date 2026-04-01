<?php

namespace App\Services;

use App\Models\Milestone;

class MilestoneService
{
    public function create($data)
    {
        return Milestone::create([
            'commission_id' => $data['commission_id'],
            'title' => $data['title'],
            'status' => 'pending',
        ]);
    }

    public function approve($milestone)
    {
        $milestone->status = 'approved';
        $milestone->save();
    }

    public function reject($milestone)
    {
        $milestone->status = 'rejected';
        $milestone->save();
    }
}