<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Models\Category;
use App\Models\Game;
use DB;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('company.games.create', compact('categories'));
    }

    public function store(StoreGameRequest $request){
        
        DB::transaction(function () use ($request){
            $imagePath = $request->file('image')->store('games','public');
            $game = Game::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'image_path' => '/storage/' . $imagePath,
                'company_id' => auth('company')->id(),
                'status' => 'pending',
            ]);
            if($request->filled('categories')){
                $game->categories()->attach($request->categories);
            }
            if($request->has('requirements')){
                foreach($request->requirements as $req){
                    $game->requirements()->create([
                        'type' => $req['type'],
                        'os' => $req['os'],
                        'cpu' => $req['cpu'],
                        'gpu' => $req['gpu'],
                        'ram' => $req['ram'],
                        'storage' => $req['storage'],
                    ]);
                }
            }
        });

        return redirect()->route('company.dashboard')->with('success','Votre jeu a été soumis avec succès ! Il est en attente de validation par un administrateur.');
    }
}
