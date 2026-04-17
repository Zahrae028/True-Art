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
        if (auth()->user()->role !== 'artist') {
            return back()->with('error', 'Only artists can create milestones');
        }

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('milestones', 'public');
            $data['file'] = '/storage/' . $path;
        }

        $this->milestoneService->create($data);
        return back()->with('success', 'Milestone uploaded successfully!');
    }

    public function approve($id)
    {
        if (auth()->user()->role !== 'client') {
            return back()->with('error', 'Only clients can approve milestones');
        }

        $milestone = Milestone::find($id);

        $this->milestoneService->approve($milestone);
        return back()->with('success', 'Milestone approved!');
    }

    public function reject($id)
    {
        if (auth()->user()->role !== 'client') {
            return back()->with('error', 'Only clients can reject milestones');
        }

        $milestone = Milestone::find($id);

        $this->milestoneService->reject($milestone);
        return back()->with('error', 'Milestone rejected - please provide feedback in chat.');
    }
}