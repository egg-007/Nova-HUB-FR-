@extends('layouts.app')

@section('title', $game->title . ' - Nova HUB')

@section('content')
    <div class="w-full max-w-5xl mx-auto px-4">

        <div class="mb-6">
            <a href="{{ route('catalog') }}" class="text-gray-400 hover:text-white transition flex items-center w-max">
                <svg width="20" height="20" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Retour au catalogue
            </a>
        </div>

        <div class="bg-novaPanel rounded-xl border border-gray-800 overflow-hidden shadow-2xl flex flex-col md:flex-row">

            <div class="w-full md:w-1/2 bg-gray-900 min-h-[300px] relative">
                @if($game->image)
                    <img src="{{ asset($game->image) }}" alt="{{ $game->title }}"
                        class="w-full h-full object-cover absolute inset-0">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-700 font-bold absolute inset-0">
                        PAS D'IMAGE
                    </div>
                @endif
            </div>

            <div class="w-full md:w-1/2 p-8 flex flex-col">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $game->title }}</h1>
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400 mr-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg width="20" height="20" fill="{{ $i <= $game->averageRating() ? 'currentColor' : 'none' }}"
                                stroke="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-gray-400 text-sm">({{ $game->reviews->count() }} avis)</span>
                </div>
                <p class="text-xl text-novaAccent mb-6">Par {{ $game->developer->name ?? 'Studio Inconnu' }}</p>

                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($game->categories as $category)
                        <span
                            class="px-3 py-1 bg-gray-800 text-gray-300 rounded text-xs uppercase tracking-wider border border-gray-700 font-bold">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                <div class="mb-8 flex-grow">
                    <h3 class="text-gray-500 font-bold uppercase tracking-wider text-sm mb-3">À propos de ce jeu</h3>
                    <p class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $game->description }}</p>
                </div>
                <div class="mt-12 border-t border-gray-800 pt-10">
                    <h2 class="text-3xl font-bold text-white mb-8">Avis de la communauté</h2>

                    @auth
                        @if(auth()->user()->ownedGames->contains($game->id) && !auth()->user()->reviews()->where('game_id', $game->id)->exists())
                            <div class="bg-novaPanel p-6 rounded-xl border border-gray-800 mb-10 shadow-inner">
                                <h3 class="text-xl font-bold text-white mb-4">Laisser une évaluation</h3>
                                <form action="{{ route('reviews.store', $game->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-gray-400 text-sm mb-2">Note (1 à 5 étoiles)</label>
                                        <select name="rating"
                                            class="bg-gray-900 border border-gray-700 text-white rounded px-4 py-2 focus:border-novaAccent outline-none">
                                            <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                            <option value="4">⭐⭐⭐⭐ (Très bon)</option>
                                            <option value="3">⭐⭐⭐ (Moyen)</option>
                                            <option value="2">⭐⭐ (Décevant)</option>
                                            <option value="1">⭐ (À éviter)</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <textarea name="comment" rows="3" placeholder="Qu'avez-vous pensé du jeu ?"
                                            class="w-full bg-gray-900 border border-gray-700 text-white rounded p-4 focus:border-novaAccent outline-none"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="bg-novaAccent text-black px-6 py-2 rounded font-bold hover:bg-cyan-400 transition">
                                        Publier mon avis
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <div class="space-y-6">
                        @forelse($game->reviews as $review)
                            <div class="bg-gray-900/50 p-6 rounded-lg border border-gray-800">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="text-novaAccent font-bold">{{ $review->user->name }}</span>
                                        <div class="flex text-yellow-400 text-xs mt-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="{{ $i <= $review->rating ? 'opacity-100' : 'opacity-20' }}">⭐</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-gray-500 text-xs">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="text-gray-300 leading-relaxed italic">"{{ $review->comment }}"</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic text-center py-10">Aucun avis pour le moment. Soyez le premier à en
                                laisser un !</p>
                        @endforelse
                    </div>
                </div>

                <div
                    class="mt-auto pt-6 border-t border-gray-800/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-4xl font-bold text-white">
                        {{ number_format($game->price, 2) }} <span class="text-2xl text-gray-500">€</span>
                    </div>

                    <div class="w-full sm:w-auto">
                        @auth
                            @if(auth()->user()->ownedGames->contains($game->id))
                                <div
                                    class="bg-green-900/30 text-green-400 border border-green-800 px-8 py-3 rounded font-bold text-center flex flex-col items-center">
                                    <span class="text-sm uppercase tracking-wider mb-1">Dans votre bibliothèque</span>
                                    <span
                                        class="font-mono text-white tracking-widest">{{ auth()->user()->ownedGames->where('id', $game->id)->first()->pivot->cd_key }}</span>
                                </div>
                            @else
                                <form action="{{ route('games.buy', $game->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-novaAccent text-black px-8 py-3 rounded font-bold hover:bg-cyan-400 transition shadow-[0_0_15px_rgba(0,255,255,0.3)] flex justify-center items-center">
                                        <svg width="20" height="20" class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                        Acheter maintenant
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gray-800 text-white px-8 py-3 rounded font-bold hover:bg-gray-700 transition text-center border border-gray-600">
                                Connectez-vous pour acheter
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection