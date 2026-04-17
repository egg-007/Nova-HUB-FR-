<?php

namespace App\Http\Controllers;

use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::with(['developer', 'categories'])->where('status', 'approved')->latest()->get();

        return view('catalog', compact('games'));
    }

    public function show(Game $game)
    {
        if ($game->status !== 'approved') {
            abort(404);
        }

        return view('games.show', compact('game'));
    }
}
