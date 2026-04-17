<?php

namespace App\Http\Controllers;

use App\Models\PortfolioPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function index()
    {
        $posts = PortfolioPost::with('artist')->latest()->get();
        return view('explore', compact('posts'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'artist') {
            return redirect('/dashboard')->with('error', 'Only artists can manage portfolios.');
        }
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'artist') {
            return redirect('/dashboard')->with('error', 'Only artists can manage portfolios.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'estimated_price' => 'nullable|numeric',
        ]);

        $path = $request->file('image')->store('portfolio', 'public');

        PortfolioPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => '/storage/' . $path,
            'estimated_price' => $request->estimated_price,
        ]);

        return redirect('/dashboard/artist')->with('success', 'Artwork added to your portfolio!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'artist') {
            return redirect('/dashboard')->with('error', 'Only artists can manage portfolios.');
        }

        $post = PortfolioPost::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized.');
        }

        $post->delete();
        return back()->with('success', 'Artwork removed from portfolio.');
    }
}
