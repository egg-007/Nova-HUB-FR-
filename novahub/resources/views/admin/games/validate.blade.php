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
                        <tr>
                            <td class="p-4 text-white">{{ $game->title }}</td>
                            <td class="p-4">{{ number_format($game->price, 2) }} €</td>
                            <td class="p-4">En attente</td>
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