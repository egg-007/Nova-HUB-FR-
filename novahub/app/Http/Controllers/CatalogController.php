<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $games = Game::where('status', 'approved')
                     ->with('categories') 
                     ->latest() 
                     ->get();

        // Send the $games variable to the blade file
        return view('catalog', compact('games'));
    }
}