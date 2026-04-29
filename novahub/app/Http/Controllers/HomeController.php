<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with(['developer', 'categories'])
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
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
        }

        $games = $query->paginate(12);

        $categories = Category::all();

        $recommendations = collect();

        if (auth()->check()) {
            $user = auth()->user();

            $ownedGameIds = $user->ownedGames()->pluck('games.id');

            if ($ownedGameIds->isNotEmpty()) {

                $favoriteCategoryIds = \DB::table('category_game')
                    ->whereIn('game_id', $ownedGameIds)
                    ->pluck('category_id')
                    ->unique();

                if ($favoriteCategoryIds->isNotEmpty()) {
                    $recommendations = Game::where('status', 'approved')
                        ->whereHas('categories', function ($q) use ($favoriteCategoryIds) {
                            $q->whereIn('categories.id', $favoriteCategoryIds);
                        })
                        ->whereNotIn('id', $ownedGameIds)
                        ->with(['developer', 'categories'])
                        ->inRandomOrder()
                        ->take(4)
                        ->get();
                }
            }
        }

        if ($recommendations->isEmpty()) {
            $recommendations = Game::where('status', 'approved')
                ->with(['developer', 'categories'])
                ->latest()
                ->take(4)
                ->get();
        }
        return view('catalog', compact('games', 'categories', 'recommendations'));
    }

    public function show(Game $game)
    {
        if ($game->status !== 'approved') {
            abort(404);
        }
        return view('games.show', compact('game'));
    }
}
