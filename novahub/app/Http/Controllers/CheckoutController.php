<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function buy(Request $request, Game $game)
    {
        $user = auth()->user();

        if ($user->ownedGames()->where('game_id', $game->id)->exists()) {
            return back()->with('error', 'Vous possédez déjà ce jeu !');
        }

        $key = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

        $user->ownedGames()->attach($game->id, ['cd_key' => $key]);

        return back()->with('success', 'Achat réussi !');
    }
}
