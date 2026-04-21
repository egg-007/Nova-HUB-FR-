<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $games = $user->ownedGames()->orderByPivot('purchased_at', 'desc')->get();

        return view('library', compact('games'));
    }
}
