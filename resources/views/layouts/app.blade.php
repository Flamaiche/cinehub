<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineHub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
<nav class="bg-indigo-600 text-white p-4">
    <div class="container mx-auto flex justify-between">
        <h1 class="font-bold text-xl">🎥 CineHub</h1>
        <a href="{{ route('films.index') }}" class="hover:underline">Films</a>
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        <a href="{{ route('contact') }}" class="hover:underline">Contact</a>
        <a href="{{ route('presentation') }}" class="hover:underline">Presentation</a>
    </div>
</nav>

<main class="py-8">
    @yield('content')
</main>
</body>
</html>
