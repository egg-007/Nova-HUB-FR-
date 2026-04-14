<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('company.games.create', compact('categories'));
    }

    public function store(StoreGameRequest $request){
        $imagePath = $request->file('image')->store('games','public');

        $game = Game::create([
            'developer_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'status' => 'pending',
            'image' => '/storage/'.$imagePath,
        ]);

        $game->categories()->attach($request->categories);

        return redirect()->route('company.dashboard')->with('success','Votre jeu a été soumis avec succès ! Il est en attente de validation par un administrateur.');
    }
}
