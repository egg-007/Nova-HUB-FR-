<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

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

    public function checkout(Game $game)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $game->title,
                        'images' => [asset($game->image)],
                    ],
                    'unit_amount' => $game->price * 100, // Stripe uses cents (15€ = 1500)
                ],
                'quantity' => 1,
            ]],

            'mode' => 'payment',
            'success_url' => route('checkout.success', $game->id) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('games.show', $game->id),
        ]);
        return redirect($session->url);
    }

    public function success(Request $request, Game $game)
    {

        if (!$request->has('session_id')) {
            return redirect()->route('catalog')->with('error', 'Paiement invalide.');
        }

        $key = strtoupper(Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4));

        auth()->user()->ownedGames()->attach($game->id, ['cd_key' => $key , 'purchased_at' => now()]);

        return redirect()->route('library')->with('success', 'Merci pour votre achat ! Le jeu a été ajouté à votre bibliothèque.');

    }
}
