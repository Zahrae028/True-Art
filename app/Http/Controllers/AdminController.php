<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard with platform statistics.
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $stats = [
            'total_users' => User::count(),
            'total_artists' => User::where('role', 'artist')->count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_commissions' => Commission::count(),
            'active_commissions' => Commission::whereIn('status', ['pending', 'accepted', 'paid'])->count(),
            'completed_commissions' => Commission::where('status', 'completed')->count(),
        ];

        $recentUsers = User::with('profile')->latest()->take(5)->get();
        $recentCommissions = Commission::with(['client', 'artist'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentCommissions'));
    }

    /**
     * Manage all users on the platform.
     */
    public function users()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        $users = User::with('profile')->latest()->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Monitor all commissions across the site.
     */
    public function commissions()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
        $commissions = Commission::with(['client', 'artist'])->latest()->get();
        return view('admin.commissions', compact('commissions'));
    }

    /**
     * Toggle the ban status of a user.
     */
    public function toggleBan($id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot ban yourself!');
        }

        $user->is_banned = !$user->is_banned;
        $user->save();

        $status = $user->is_banned ? 'banned' : 'unbanned';
        return back()->with('success', "User '{$user->name}' has been {$status} successfully.");
    }

    /**
     * Promote a user to Admin role.
     */
    public function promoteAdmin($id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'This user is already an administrator.');
        }

        $user->role = 'admin';
        $user->save();

        return back()->with('success', "User '{$user->name}' has been promoted to Administrator.");
    }
}
