@extends('layouts.app')

@section('title', 'Administration - Nova HUB')

@section('content')
<div class="w-full max-w-7xl mx-auto px-4">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white">Centre de Commandement</h1>
        <p class="text-gray-400">Gérez la plateforme, surveillez les statistiques et validez les nouveaux jeux.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-novaPanel border border-yellow-800/50 rounded-lg p-6">
            <h3 class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-2">Validation Requise</h3>
            <p class="text-3xl font-bold text-yellow-400 mb-4">Jeux en attente</p>
            <a href="{{ route('admin.queue') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500/10 text-yellow-400 rounded border border-yellow-500/20 hover:bg-yellow-500 hover:text-black transition font-semibold text-sm">
                Ouvrir la file d'attente
            </a>
        </div>
        <div class="bg-novaPanel border border-gray-800 rounded-lg p-6">
            <h3 class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-2">Catalogue Actif</h3>
            <p class="text-4xl font-bold text-white">Approuvés</p>
        </div>
        <div class="bg-novaPanel border border-gray-800 rounded-lg p-6">
            <h3 class="text-gray-400 text-sm font-bold uppercase tracking-wider mb-2">Communauté</h3>
            <p class="text-4xl font-bold text-novaAccent">Utilisateurs</p>
        </div>
    </div>
</div>
@endsection