<nav class="bg-indigo-600 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="font-bold text-xl">🎥 CineHub</h1>

        <div class="flex gap-6 items-center">
            <a href="{{ route('films.index') }}" class="hover:underline">Films</a>
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
            <a href="{{ route('presentation') }}" class="hover:underline">Presentation</a>

            @guest
                <!-- Liens pour les utilisateurs non connectés -->
                <a href="/login" class="hover:underline">Connexion</a>
                <a href="/register" class="hover:underline">Inscription</a>
            @endguest

            @auth
                <!-- Liens pour les utilisateurs connectés -->
                <div class="flex gap-4 items-center">
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="hover:underline bg-transparent border-0 cursor-pointer text-white">
                            Déconnexion
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
