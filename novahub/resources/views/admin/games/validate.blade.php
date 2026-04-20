@extends('layouts.app')

@section('title', 'Validation des Jeux - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-4xl font-bold text-white">File d'attente</h1>
            <p class="text-gray-400">Examinez et validez les jeux soumis par les studios.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-novaAccent hover:text-white transition">Retour au centre</a>
    </div>

    <div class="bg-novaPanel rounded-lg border border-gray-800 overflow-hidden backdrop-blur-md shadow-2xl">
        @if($pendingGames->count() > 0)
            <table class="w-full text-left border-collapse">
                <tbody class="text-gray-300">
                    @foreach($pendingGames as $game)
                        <tr class="border-b border-gray-800/50 hover:bg-gray-800/20 transition">
                            <td class="p-4 text-white font-bold">{{ $game->title }}</td>
                            <td class="p-4">{{ number_format($game->price, 2) }} €</td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-yellow-900/30 text-yellow-400 text-xs rounded border border-yellow-800">
                                    En attente
                                </span>
                            </td>
                            
                            <td class="p-4">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('admin.games.approve', $game->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-green-900/30 text-green-400 rounded border border-green-800 hover:bg-green-500 hover:text-black transition" title="Approuver">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.games.reject', $game->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="p-2 bg-red-900/30 text-red-400 rounded border border-red-800 hover:bg-red-500 hover:text-black transition" title="Rejeter">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-16 text-center text-white">
                <h3 class="text-xl font-bold mb-2">La file d'attente est vide</h3>
            </div>
        @endif
    </div>
</div>
@endsection