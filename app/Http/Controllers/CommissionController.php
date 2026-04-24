<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CommissionService;


class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    public function store(Request $request)
    {
        $this->commissionService->create($request->all(), Auth::user());
        return redirect('/dashboard')->with('success', 'Commission request sent successfully!');
    }

    public function accept(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->artist_id) {
            return back()->with('error', 'Unauthorized. Only the assigned artist can accept this commission.');
        }

        $this->commissionService->accept($commission, $request->price);
        return back()->with('success', 'Commission Price Quoted! Awaiting client approval.');
    }

    public function approveQuote($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->client_id) {
            return back()->with('error', 'Unauthorized. Only the client can approve this quote.');
        }

        $result = $this->commissionService->approveQuote($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Quote approved! You can now proceed with milestones and payment.');
    }

    public function declineQuote($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->client_id) {
            return back()->with('error', 'Unauthorized. Only the client can decline this quote.');
        }

        $result = $this->commissionService->declineQuote($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Commission declined and cancelled.');
    }

    public function payDeposit($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->client_id) {
            return back()->with('error', 'Unauthorized. Only the client can make payments.');
        }

        $result = $this->commissionService->payDeposit($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Deposit paid successfully! The artist will now begin work.');
    }

    public function refundDeposit($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->client_id) {
            return back()->with('error', 'Unauthorized. Only the client can request a refund.');
        }

        $result = $this->commissionService->refundDeposit($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Deposit refunded successfully. The commission has been cancelled.');
    }

    public function payFinal($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->client_id) {
            return back()->with('error', 'Unauthorized. Only the client can make payments.');
        }

        $result = $this->commissionService->payFinal($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Final payment successful! The artist can now deliver the final assets.');
    }

    public function complete($id)
    {
        $commission = Commission::findOrFail($id);

        if (Auth::id() !== $commission->artist_id) {
            return back()->with('error', 'Unauthorized. Only the assigned artist can mark this commission as complete.');
        }

        $result = $this->commissionService->complete($commission);
        
        if (is_string($result)) {
            return back()->with('error', $result);
        }

        return back()->with('success', 'Perfect! Commission marked as complete.');
    }
}