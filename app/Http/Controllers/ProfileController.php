<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?: new Profile(['user_id' => $user->id]);

        if ($request->has('bio')) {
            $profile->bio = $request->bio;
        }

        if ($request->has('specialty')) {
            $profile->specialty = $request->specialty;
        }

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->avatar = '/storage/' . $path;
        }

        $profile->save();

        if ($request->has('name')) {
            $user->name = $request->name;
            $user->save();
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
