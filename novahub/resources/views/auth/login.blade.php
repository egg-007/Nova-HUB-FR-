@extends('layouts.app')

@section('title', 'Connexion - Nova HUB')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-novaPanel p-8 rounded-lg shadow-lg border border-gray-800">
    <h2 class="text-3xl font-bold text-white text-center mb-6">Connexion</h2>

    @if ($errors->any())
        <div class="bg-red-900 border border-red-500 text-red-200 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-400 mb-2">Adresse Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
        </div>

        <div class="mb-6">
            <label for="password" class="block text-gray-400 mb-2">Mot de passe</label>
            <input id="password" type="password" name="password" required class="w-full bg-novaDark text-white border border-gray-700 rounded p-2 focus:border-novaAccent focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-novaAccent text-black font-bold py-2 px-4 rounded hover:bg-cyan-400 transition">
            Se connecter
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-gray-400">Pas encore de compte ? <a href="{{ url('/register') }}" class="text-novaAccent hover:underline">S'inscrire</a></p>
    </div>
</div>
@endsection