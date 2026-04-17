@extends('layouts.app')

@section('title', 'Soumettre un Jeu - Nova HUB')

@section('content')
<div class="w-full max-w-3xl mx-auto px-4">
    
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Soumettre un nouveau jeu</h1>
            <p class="text-gray-400">Remplissez les détails pour envoyer votre jeu en validation.</p>
        </div>
        <a href="{{ route('company.dashboard') }}" class="text-gray-400 hover:text-white transition">Retour</a>
    </div>

    <form action="{{ route('company.games.store') }}" method="POST" enctype="multipart/form-data" class="bg-novaPanel p-8 rounded-lg border border-gray-800 shadow-xl backdrop-blur-sm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-400 text-sm font-bold mb-2">Titre du jeu</label>
                <input type="text" name="title" required class="w-full bg-gray-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-novaAccent focus:outline-none transition">
            </div>
            <div>
                <label class="block text-gray-400 text-sm font-bold mb-2">Prix (€)</label>
                <input type="number" step="0.01" name="price" required class="w-full bg-gray-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-novaAccent focus:outline-none transition">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-400 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="5" required class="w-full bg-gray-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-novaAccent focus:outline-none transition"></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-400 text-sm font-bold mb-3">Genres (Catégories)</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @foreach($categories as $category)
                    <label class="flex items-center space-x-2 text-gray-300 cursor-pointer hover:text-white transition">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="rounded bg-gray-900 border-gray-700 text-novaAccent focus:ring-novaAccent">
                        <span class="text-sm">{{ $category->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-gray-400 text-sm font-bold mb-2">Image de couverture (Optionnel)</label>
            <input type="file" name="image" accept="image/*" class="w-full text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gray-800 file:text-white hover:file:bg-gray-700 transition">
        </div>

        <button type="submit" class="w-full bg-novaAccent text-black font-bold text-lg py-3 rounded hover:bg-cyan-400 transition shadow-[0_0_15px_rgba(0,255,255,0.2)]">
            Envoyer pour validation
        </button>
    </form>
</div>
@endsection