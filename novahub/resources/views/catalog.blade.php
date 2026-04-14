@extends('layouts.app')

@section('title', 'Catalogue des Jeux - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white">Découvrez nos jeux</h1>
        <p class="text-gray-400">Trouvez votre prochaine aventure sur Nova HUB.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @foreach($games as $game)
            <div class="bg-novaPanel rounded-lg overflow-hidden border border-gray-800 hover:border-novaAccent transition duration-300">
                
                <img src="{{ $game->image }}" alt="{{ $game->title }}" class="w-full h-48 object-cover">
                
                <div class="p-4">
                    <h3 class="text-xl font-bold text-white mb-2">{{ $game->title }}</h3>
                    
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($game->categories as $category)
                            <span class="px-2 py-1 bg-gray-800 text-novaAccent text-xs rounded-full">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <span class="text-lg font-bold text-white">{{ number_format($game->price, 2) }} €</span>
                        <button class="bg-novaAccent text-black px-4 py-2 rounded font-semibold text-sm hover:bg-cyan-400 transition">
                            Voir plus
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection