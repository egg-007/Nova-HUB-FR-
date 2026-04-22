<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $user = auth()->user();

        if ($user->reviews()->where('game_id', $game->id)->exists() || ! $user->ownedGames()->where('game_id', $game->id)->exists()) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour ce jeu ou vous ne l\'avez pas acheté !');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::updateOrCreate(
            ['user_id' => $user->id, 'game_id' => $game->id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Merci pour votre avis !');
    }
}
