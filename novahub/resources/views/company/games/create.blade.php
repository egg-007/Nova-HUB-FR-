@extends('layouts.app')

@section('title', 'Soumettre un Jeu')

@section('content')
<div class="max-w-2xl mx-auto bg-novaPanel p-8 rounded-lg">
    <h2 class="text-2xl font-bold text-white mb-6">Soumettre un nouveau jeu</h2>

    <form action="{{ route('company.games.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-400 mb-2">Titre du jeu</label>
            <input type="text" name="title" class="w-full bg-novaDark text-white border border-gray-700 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-400 mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full bg-novaDark text-white border border-gray-700 rounded p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-400 mb-2">Prix (€)</label>
            <input type="number" step="0.01" name="price" class="w-full bg-novaDark text-white border border-gray-700 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-400 mb-2">Catégories (Genres)</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($categories as $category)
                    <label class="flex items-center text-white">
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="mr-2">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-400 mb-2">Image de couverture</label>
            <input type="file" name="image" accept="image/*" class="w-full text-white" required>
        </div>

        <button type="submit" class="bg-novaAccent text-black font-bold py-2 px-4 rounded hover:bg-cyan-400 transition">
            Soumettre pour validation
        </button>
    </form>
</div>
@endsection