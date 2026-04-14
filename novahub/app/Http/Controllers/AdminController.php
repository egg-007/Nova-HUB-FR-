<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create()
    {
        return view('admin.games.validate');
    }

    public function approve(Game $game)
    {
        $game->update(['status' => 'approved']);
        return redirect()->route('admin.games.validate')->with('success', 'Le jeu "' . $game->title . '" a été approuvé et publié dans le catalogue !');
    }

    public function reject(Game $game)
    {
        $game->update(['status' => 'rejected']);
        return redirect()->route('admin.games.validate')->with('success', 'Le jeu "' . $game->title . '" a été rejeté et ne sera pas publié dans le catalogue.');
    }
}
