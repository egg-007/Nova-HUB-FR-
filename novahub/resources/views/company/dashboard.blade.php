@extends('layouts.app')

@section('title', 'Tableau de bord Studio - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-bold text-white">Mon Studio</h1>
            <p class="text-gray-400">Gérez vos jeux et suivez leur statut de validation.</p>
        </div>
        <a href="{{ route('company.games.create') }}" class="bg-novaAccent text-black px-6 py-3 rounded font-bold hover:bg-cyan-400 transition shadow-[0_0_15px_rgba(0,255,255,0.3)]">
            + Soumettre un nouveau jeu
        </a>
    </div>

    <div class="bg-novaPanel rounded-lg border border-gray-800 overflow-hidden backdrop-blur-sm">
        
        @if($games->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900 border-b border-gray-800 text-gray-400 text-sm uppercase tracking-wider">
                            <th class="p-4">Jeu</th>
                            <th class="p-4">Prix</th>
                            <th class="p-4">Statut</th>
                            <th class="p-4">Date d'ajout</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @foreach($games as $game)
                            <tr class="border-b border-gray-800 hover:bg-gray-800/50 transition">
                                
                                <td class="p-4 flex items-center gap-4">
                                    @if($game->image)
                                        <img src="{{ $game->image }}" alt="{{ $game->title }}" class="w-12 h-12 rounded object-cover border border-gray-700">
                                    @else
                                        <div class="w-12 h-12 rounded bg-gray-800 flex items-center justify-center text-xs border border-gray-700">Img</div>
                                    @endif
                                    <span class="font-bold text-white">{{ $game->title }}</span>
                                </td>
                                
                                <td class="p-4">{{ number_format($game->price, 2) }} €</td>
                                
                                <td class="p-4">
                                    @if($game->status === 'approved')
                                        <span class="px-3 py-1 bg-green-900/50 text-green-400 border border-green-800 rounded-full text-xs font-bold">Approuvé</span>
                                    @elseif($game->status === 'rejected')
                                        <span class="px-3 py-1 bg-red-900/50 text-red-400 border border-red-800 rounded-full text-xs font-bold">Rejeté</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-900/50 text-yellow-400 border border-yellow-800 rounded-full text-xs font-bold">En attente</span>
                                    @endif
                                </td>
                                
                                <td class="p-4">{{ $game->created_at->format('d/m/Y') }}</td>
                                
                                <td class="p-4">
                                    <button class="text-gray-400 hover:text-novaAccent transition text-sm">Voir détails</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-xl font-bold text-white mb-2">Aucun jeu publié</h3>
                <p class="text-gray-400">Commencez par soumettre votre premier jeu pour qu'il soit validé par un administrateur.</p>
            </div>
        @endif

    </div>
</div>
@endsection