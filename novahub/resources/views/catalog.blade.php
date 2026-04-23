@extends('layouts.app')

@section('title', 'Catalogue - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    
    <div class="mb-10 text-center md:text-left">
        <h1 class="text-5xl font-bold text-white mb-4">Découvrez de <span class="text-novaAccent">Nouveaux Mondes</span></h1>
        <p class="text-xl text-gray-400">Explorez les meilleurs jeux créés par nos studios indépendants.</p>
    </div>

    @if($games->count() > 0)
    <div class="mb-10 bg-novaPanel p-6 rounded-xl border border-gray-800 shadow-lg">
        <form action="{{ route('catalog') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            
            <div class="flex-grow relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg width="20" height="20" class="text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un jeu (ex: Cyberpunk...)" class="w-full pl-10 pr-4 py-3 bg-gray-900 border border-gray-700 rounded text-white focus:outline-none focus:border-novaAccent transition">
            </div>

            <div class="md:w-64">
                <select name="category" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded text-gray-300 focus:outline-none focus:border-novaAccent transition appearance-none">
                    <option value="">Toutes les catégories</option>
                    
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:w-48">
    <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded text-gray-300 focus:border-novaAccent outline-none appearance-none">
        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Nouveautés</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix : Croissant</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix : Décroissant</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus anciens</option>
    </select>
</div>

            <button type="submit" class="bg-novaAccent text-black px-8 py-3 rounded font-bold hover:bg-cyan-400 transition">
                Filtrer
            </button>
            
            @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('catalog') }}" class="bg-gray-800 text-white px-6 py-3 rounded font-bold hover:bg-gray-700 transition border border-gray-600 flex items-center justify-center">
                    Réinitialiser
                </a>
            @endif
        </form>
    </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($games as $game)
                <div class="bg-novaPanel rounded-lg border border-gray-800 overflow-hidden hover:border-novaAccent/50 transition group flex flex-col h-full shadow-lg">
                    
                    <div class="aspect-video w-full bg-gray-900 relative overflow-hidden">
                        @if($game->image)
                            <img src="{{ asset($game->image) }}" alt="{{ $game->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-700 font-bold">
                                PAS D'IMAGE
                            </div>
                        @endif
                        <div class="absolute top-2 right-2 bg-black/80 backdrop-blur text-white px-2 py-1 rounded text-sm font-bold border border-gray-700">
                            {{ number_format($game->price, 2) }} €
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-xl font-bold text-white mb-1 truncate" title="{{ $game->title }}">{{ $game->title }}</h3>
                        <p class="text-sm text-novaAccent mb-3">{{ $game->developer->name ?? 'Studio Inconnu' }}</p>
                        
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach($game->categories->take(3) as $category)
                                <span class="text-xs bg-gray-800 text-gray-300 px-2 py-1 rounded">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        <div class="mt-auto">
                            <a href="{{ route('games.show', $game->id) }}" class="block w-full text-center bg-gray-800 hover:bg-novaAccent hover:text-black text-white py-2 rounded transition font-bold">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-novaPanel rounded-lg border border-gray-800">
            <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            <h3 class="text-2xl font-bold text-white mb-2">Le catalogue est vide</h3>
            <p class="text-gray-400">Aucun jeu n'a encore été approuvé. Revenez plus tard !</p>
        </div>
    @endif
</div>
@endsection