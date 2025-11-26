<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - CinéHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="bg-white rounded-2xl shadow-2xl p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Inscription</h1>
            <p class="text-gray-600">Créez votre compte CinéHub</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-600 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom
                </label>
                <input
                    type="text"
                    name="nom"
                    id="nom"
                    value="{{ old('nom') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('nom') border-red-500 @enderror"
                    placeholder="Dupont"
                >
                @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">
                    Prénom
                </label>
                <input
                    type="text"
                    name="prenom"
                    id="prenom"
                    value="{{ old('prenom') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('prenom') border-red-500 @enderror"
                    placeholder="Jean"
                >
                @error('prenom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse email
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                    placeholder="votre@email.com"
                >
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 @error('password') border-red-500 @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le mot de passe
                </label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                    placeholder="••••••••"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition duration-200 transform hover:scale-[1.02] shadow-lg mt-6"
            >
                S'inscrire
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Déjà un compte ?
                <a href="/login" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
