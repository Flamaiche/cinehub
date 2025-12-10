@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Liste des Films</h1>

        <!-- Alert succès / erreur -->
        @if(session()->has('success'))
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif
        @endif

        <form action="{{ route('films.index') }}" method="GET" class="mb-6 flex justify-center">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Rechercher un film..."
                class="border border-gray-300 rounded-l px-4 py-2 w-1/3"
            />
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r hover:bg-indigo-700">
                Rechercher
            </button>
        </form>

        <!-- Bouton Ajouter un film uniquement si l'utilisateur peut créer -->
        @can('create', App\Models\Film::class)
            <div class="text-center mb-6 flex justify-center">
                <a href="{{ route('films.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded">
                    Ajouter un film
                </a>
            </div>
        @endcan

        <!-- Liste des films -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($films as $film)
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

                            <!-- Actions Modifier/Supprimer seulement si autorisé -->
                            @canany(['update', 'delete'], $film)
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
                            @endcanany
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">Aucun film trouvé.</p>
            @endforelse
        </div>
    </div>
@endsection
