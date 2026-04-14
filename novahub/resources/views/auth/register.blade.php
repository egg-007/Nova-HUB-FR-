@extends('layouts.app')

@section('title', 'Inscription - Nova HUB')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-novaPanel p-8 rounded-lg shadow-lg border border-gray-800">
    <h2 class="text-3xl font-bold text-white text-center mb-6">Créer un compte</h2>

    @if ($errors->any())
        <div class="bg-red-900 border border-red-500 text-red-200 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label for="first_name" class="block text-gray-400 mb-2">Prénom</label>
                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
            </div>
            <div>
                <label for="last_name" class="block text-gray-400 mb-2">Nom</label>
                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
            </div>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-400 mb-2">Adresse Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-400 mb-2">Mot de passe</label>
            <input id="password" type="password" name="password" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-400 mb-2">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
        </div>

        <div class="mb-6">
            <label for="role" class="block text-gray-400 mb-2">Type de compte</label>
            <select id="role" name="role" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
                <option value="player">Joueur (Acheter des jeux)</option>
                <option value="company">Studio / Entreprise (Publier des jeux)</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-novaAccent text-black font-bold py-2 px-4 rounded hover:bg-cyan-400 transition">
            S'inscrire
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-gray-400">Déjà un compte ? <a href="{{ url('/login') }}" class="text-novaAccent hover:underline">Se connecter</a></p>
    </div>
</div>
@endsection