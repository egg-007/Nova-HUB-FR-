<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with(['developer', 'categories'])->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category); 
            });
        }

        switch ($request->get('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $games = $query->get();

        $categories = Category::all();

        return view('catalog', compact('games', 'categories'));
    }

    public function show(Game $game)
    {
        if ($game->status !== 'approved') {
            abort(404);
        }

        return view('games.show', compact('game'));
    }
}
