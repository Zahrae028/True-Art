<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Container\Attributes\Auth;
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
        $this->commissionService->create($request->all(), authUser());
        return back();
    }

    public function accept($id)
    {
        $commission = Commission::find($id);

        $this->commissionService->accept($commission);

        return back();
    }
    public function pay($id)
{
    $commission = Commission::find($id);

    $this->commissionService->pay($commission);

    return back();
}

public function complete($id)
{
    $commission = Commission::find($id);

    $this->commissionService->complete($commission);

    return back();
}
}