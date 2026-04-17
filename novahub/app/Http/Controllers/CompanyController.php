<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $games = auth()->user()->publishedGames()->latest()->get();
        
        return view('company.dashboard', compact('games'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('company.create', compact('categories'));
    }

    public function store(StoreGameRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('games', 'public');
            $imagePath = '/storage/' . $path; 
        }

        $game = Game::create([
            'developer_id' => auth()->id(), 
            'title'        => $request->title,
            'description'  => $request->description,
            'price'        => $request->price,
            'image'        => $imagePath,
            'status'       => 'pending',
        ]);

        $game->categories()->attach($request->categories);

        return redirect()->route('company.dashboard');

    }
}
