@extends('layouts.app')

@section('title', $game->title . ' - Nova HUB')

@section('content')
    <div class="w-full max-w-5xl mx-auto px-4">

        <div class="mb-6">
            <a href="{{ route('catalog') }}" class="text-gray-400 hover:text-white transition flex items-center w-max">
                <svg width="20" height="20" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Retour au catalogue
            </a>
        </div>

        <div class="bg-novaPanel rounded-xl border border-gray-800 overflow-hidden shadow-2xl flex flex-col md:flex-row">

            <div class="w-full md:w-1/2 bg-gray-900 min-h-[300px] relative">
                @if($game->image)
                    <img src="{{ asset($game->image) }}" alt="{{ $game->title }}"
                        class="w-full h-full object-cover absolute inset-0">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-700 font-bold absolute inset-0">
                        PAS D'IMAGE
                    </div>
                @endif
            </div>

            <div class="w-full md:w-1/2 p-8 flex flex-col">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $game->title }}</h1>
                <p class="text-xl text-novaAccent mb-6">Par {{ $game->developer->name ?? 'Studio Inconnu' }}</p>

                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($game->categories as $category)
                        <span
                            class="px-3 py-1 bg-gray-800 text-gray-300 rounded text-xs uppercase tracking-wider border border-gray-700 font-bold">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="mb-8 flex-grow">
                    <h3 class="text-gray-500 font-bold uppercase tracking-wider text-sm mb-3">À propos de ce jeu</h3>
                    <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $game->description }}</p>
                </div>

                <div
                    class="mt-auto pt-6 border-t border-gray-800/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-4xl font-bold text-white">
                        {{ number_format($game->price, 2) }} <span class="text-2xl text-gray-500">€</span>
                    </div>

                    <div class="w-full sm:w-auto">
                        @auth
                            @if(auth()->user()->ownedGames->contains($game->id))
                                <div
                                    class="bg-green-900/30 text-green-400 border border-green-800 px-8 py-3 rounded font-bold text-center flex flex-col items-center">
                                    <span class="text-sm uppercase tracking-wider mb-1">Dans votre bibliothèque</span>
                                    <span
                                        class="font-mono text-white tracking-widest">{{ auth()->user()->ownedGames->where('id', $game->id)->first()->pivot->cd_key }}</span>
                                </div>
                            @else
                                <form action="{{ route('games.buy', $game->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-novaAccent text-black px-8 py-3 rounded font-bold hover:bg-cyan-400 transition shadow-[0_0_15px_rgba(0,255,255,0.3)] flex justify-center items-center">
                                        <svg width="20" height="20" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        Acheter maintenant
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gray-800 text-white px-8 py-3 rounded font-bold hover:bg-gray-700 transition text-center border border-gray-600">
                                Connectez-vous pour acheter
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection