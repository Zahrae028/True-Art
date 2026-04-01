<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;
use ResourceBundle;
use App\Services\MilestoneService;

class MilestoneController extends Controller
{
    protected $milestoneService;

    public function __construct(MilestoneService $milestoneService)
    {
        $this->milestoneService = $milestoneService;
    }

    public function store(Request $request)
    {
        // Only artist can create milestone
        if (authUser()->role !== 'artist') {
            return "Only artists can create milestones";
        }

        $this->milestoneService->create($request->all());

        return back();
    }

    public function approve($id)
    {
        // Only client can approve
        if (authUser()->role !== 'client') {
            return "Only clients can approve";
        }

        $milestone = Milestone::find($id);

        $this->milestoneService->approve($milestone);

        return back();
    }

    public function reject($id)
    {
        // Only client can reject
        if (authUser()->role !== 'client') {
            return "Only clients can reject";
        }

        $milestone = Milestone::find($id);

        $this->milestoneService->reject($milestone);

        return back();
    }
}