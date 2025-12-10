<div>
    <a href="{{ route('films.show', $film->id) }}">
        <div class="border rounded-lg shadow p-4">
            <div class="bg-white shadow-lg rounded-2xl p-4 hover:shadow-xl transition">
                @php
                    $media = $film->medias()->first();
                @endphp
                @if($media)
                    <img src="{{ $media->url }}" alt="Affiche de {{ $film->titre }}" class="w-full h-auto object-contain rounded-xl mb-4">
                @endif

                <h2 class="text-xl font-semibold mb-2">{{ $film->titre }}</h2>
                <p class="text-sm text-gray-500 mb-1">Sortie : {{ $film->date_sortie }}</p>
                <p class="text-sm mb-3">Durée : {{ $film->duree }} min</p>
                <p class="text-gray-700 text-sm mb-3">{{ Str::limit($film->synopsis, 120) }}</p>
                <p class="font-bold text-yellow-600">⭐ {{ $film->note }}/5</p>
            </div>

            <div class="mt-4 text-center flex justify-center gap-4">
                @can('update', $film)
                    <a href="{{ route('films.edit', $film->id) }}"
                       class="bg-yellow-500 shadow-lg text-white px-4 py-2 rounded hover:bg-yellow-600 hover:shadow-xl transition">
                        ✏️ Modifier
                    </a>
                @endcan

                @can('delete', $film)
                    <form action="{{ route('films.destroy', $film->id) }}" method="POST"
                          onsubmit="return confirm('⚠️ Voulez-vous vraiment supprimer ce film {{$film->titre}} ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 shadow-lg text-white px-4 py-2 rounded hover:bg-red-700 hover:shadow-xl transition">
                            🗑️ Supprimer
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </a>
</div>
