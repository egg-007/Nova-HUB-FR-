@extends('layouts.app')

@section('title', 'Validation des Jeux')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-white mb-6">Jeux en attente de validation</h2>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-200 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900 border border-red-500 text-red-200 px-4 py-3 rounded relative mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($games->isEmpty())
        <div class="bg-novaPanel p-8 rounded-lg text-center border border-gray-800">
            <p class="text-gray-400 text-lg">Aucun jeu n'est en attente de validation pour le moment.</p>
            <p class="text-gray-500 text-sm mt-2">La file d'attente est vide !</p>
        </div>
    @else
        <div class="bg-novaPanel rounded-lg shadow overflow-hidden border border-gray-800">
            <table class="min-w-full divide-y divide-gray-800">
                <thead class="bg-novaDark">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Jeu</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Développeur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Prix</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($games as $game)
                        <tr class="hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded object-cover border border-gray-700" src="{{ $game->image }}" alt="Image de {{ $game->title }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-white">{{ $game->title }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ $game->developer->first_name }} {{ $game->developer->last_name }}</div>
                                <div class="text-xs text-gray-500">{{ $game->developer->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 font-semibold">
                                {{ number_format($game->price, 2) }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $game->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    
                                    <form action="{{ route('admin.games.approve', $game) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded text-sm font-bold transition">
                                            Approuver
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.games.reject', $game) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded text-sm font-bold transition">
                                            Rejeter
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection