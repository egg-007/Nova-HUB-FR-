<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard()
    {
        $games = auth()->user()->publishedGames()->latest()->get();
        
        return view('company.dashboard', compact('games'));
    }
}
