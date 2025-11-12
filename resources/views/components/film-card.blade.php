<div class="bg-white shadow-lg rounded-2xl p-4 hover:shadow-xl transition">
    @if($film->media)
        <img src="{{ $film->media }}" alt="Affiche de {{ $film->titre }}" class="w-full h-auto object-contain rounded-xl mb-4">
    @endif

    <h2 class="text-xl font-semibold mb-2">{{ $film->titre }}</h2>
    <p class="text-sm text-gray-500 mb-1">Sortie : {{ $film->date_sortie }}</p>
    <p class="text-sm mb-3">Durée : {{ $film->duree }} min</p>
    <p class="text-gray-700 text-sm mb-3">{{ Str::limit($film->synopsis, 120) }}</p>
    <p class="font-bold text-yellow-600">⭐ {{ $film->note }}/5</p>
</div>
