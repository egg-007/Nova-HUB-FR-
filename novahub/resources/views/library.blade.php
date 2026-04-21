@extends('layouts.app')

@section('title', 'Ma Bibliothèque - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    
    <div class="mb-10 flex items-center justify-between border-b border-gray-800 pb-6">
        <div>
            <h1 class="text-4xl font-bold text-white mb-2">Ma Bibliothèque</h1>
            <p class="text-gray-400">Retrouvez tous vos jeux et clés d'activation ici.</p>
        </div>
        <div class="bg-gray-800/50 px-4 py-2 rounded-lg border border-gray-700">
            <span class="text-gray-400 text-sm">Jeux possédés:</span>
            <span class="text-novaAccent font-bold text-xl ml-2">{{ $games->count() }}</span>
        </div>
    </div>

    @if($games->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($games as $game)
                <div class="bg-novaPanel rounded-xl border border-gray-800 overflow-hidden shadow-lg flex flex-col">
                    
                    <div class="aspect-[16/9] w-full bg-gray-900 relative">
                        @if($game->image)
                            <img src="{{ asset($game->image) }}" alt="{{ $game->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-700 font-bold">
                                PAS D'IMAGE
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-2xl font-bold text-white mb-1">{{ $game->title }}</h3>
                        <p class="text-sm text-gray-400 mb-6">Développé par {{ $game->developer->name ?? 'Studio Inconnu' }}</p>

                        <div class="mt-auto bg-gray-900 rounded border border-gray-700 p-4 text-center">
                            <span class="block text-xs text-gray-500 uppercase tracking-widest mb-2">Clé d'activation (CD-KEY)</span>
                            <span class="block text-xl font-mono text-green-400 tracking-[0.2em] font-bold">
                                {{ $game->pivot->cd_key }}
                            </span>
                        </div>
                    </div>
                    
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-24 bg-novaPanel rounded-xl border border-gray-800 border-dashed">
            <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            <h3 class="text-2xl font-bold text-white mb-2">Votre bibliothèque est vide</h3>
            <p class="text-gray-400 mb-6">Vous n'avez pas encore acheté de jeux.</p>
            <a href="{{ route('catalog') }}" class="inline-block bg-novaAccent text-black px-6 py-2 rounded font-bold hover:bg-cyan-400 transition">
                Explorer le catalogue
            </a>
        </div>
    @endif

</div>
@endsection