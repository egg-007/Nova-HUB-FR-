<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Nova HUB')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white antialiased min-h-screen flex flex-col">
    
    <nav class="bg-novaDark border-b border-gray-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/catalog" class="text-xl font-bold text-novaAccent">Nova HUB</a>

            <div>
                @auth
                    <span class="mr-4 text-gray-400">Bonjour, {{ auth()->user()->first_name }}</span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 transition">
                            Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 text-gray-300 hover:text-white">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-novaAccent text-black px-4 py-2 rounded font-bold hover:bg-cyan-400 transition">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow py-12">
        @yield('content')
    </main>

</body>
</html>