<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineHub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
@include('components.header')

<main class="py-8">
    @yield('content')
</main>

@include('components.footer')

</body>
</html>
