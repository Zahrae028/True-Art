<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $artists = User::where('role', 'artist')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhereHas('profile', function ($pq) use ($search) {
                          $pq->where('specialty', 'like', "%{$search}%")
                             ->orWhere('bio', 'like', "%{$search}%");
                      });
                });
            })
            ->with('profile')
            ->get();

        return view('artists', compact('artists', 'search'));
    }
}
