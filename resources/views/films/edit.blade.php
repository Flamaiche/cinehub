@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Modifier le Film</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('films.update', $film->id) }}"
              method="POST"
              onsubmit="return confirm('Êtes-vous sûr de vouloir modifier ce film {{$film->titre}} ?');"
              class="space-y-3">
            @csrf
            @method('PUT')

            <input type="text" name="titre" placeholder="Titre" value="{{ old('titre', $film->titre) }}"
                   class="w-full border rounded px-2 py-1">

            <input type="date" name="date_sortie" value="{{ old('date_sortie', $film->date_sortie) }}"
                   class="w-full border rounded px-2 py-1">

            <textarea name="synopsis" placeholder="Synopsis" class="w-full border rounded px-2 py-1">{{ old('synopsis', $film->synopsis) }}</textarea>

            <input type="number" name="duree" placeholder="Durée (min)" value="{{ old('duree', $film->duree) }}"
                   class="w-full border rounded px-2 py-1">

            <input type="number" step="0.1" min="0" max="5" name="note" placeholder="Note"
                   value="{{ old('note', $film->note) }}" class="w-full border rounded px-2 py-1">

            {{-- Sélection des genres --}}
            <label for="genres" class="block font-semibold mt-2">Genres</label>
            <select name="genres[]" id="genres" multiple class="w-full border rounded px-2 py-1">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                            @if($film->genres->contains($genre->id)) selected @endif>
                        {{ $genre->nom }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                Mettre à jour
            </button>
        </form>

        {{-- Gestion des acteurs du film --}}
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-3">Acteurs</h2>

            {{-- Acteurs déjà liés --}}
            @forelse($film->acteurs as $acteur)
                <form action="{{ route('films.updateActor', [$film->id, $acteur->id]) }}"
                      method="POST"
                      class="mb-2 flex flex-wrap gap-2 items-center">
                    @csrf
                    @method('PUT')

                    <span class="font-semibold mr-2">
                        {{ $acteur->nom }}
                    </span>

                    <input type="text" name="role"
                           value="{{ old('role', $acteur->pivot->role) }}"
                           placeholder="Rôle"
                           class="border rounded px-2 py-1">

                    <input type="number" name="note"
                           value="{{ old('note', $acteur->pivot->note) }}"
                           min="0" max="10"
                           placeholder="Note"
                           class="border rounded px-2 py-1 w-20">

                    <button type="submit"
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                        Mettre à jour
                    </button>
                </form>

                <form action="{{ route('films.detachActor', [$film->id, $acteur->id]) }}"
                      method="POST"
                      class="mb-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                        Retirer cet acteur
                    </button>
                </form>
            @empty
                <p class="text-sm text-gray-500 mb-4">Aucun acteur associé pour le moment.</p>
            @endforelse

            {{-- Ajouter un acteur --}}
            <form action="{{ route('films.attachActor', $film->id) }}"
                  method="POST"
                  class="mt-4 flex flex-wrap gap-2 items-center">
                @csrf

                <select name="acteur_id" class="border rounded px-2 py-1">
                    @foreach($acteurs as $acteur)
                        <option value="{{ $acteur->id }}">{{ $acteur->nom }}</option>
                    @endforeach
                </select>

                <input type="text" name="role" placeholder="Rôle"
                       class="border rounded px-2 py-1">

                <input type="number" name="note" placeholder="Note" min="0" max="10"
                       class="border rounded px-2 py-1 w-20">

                <button type="submit"
                        class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                    Ajouter un acteur
                </button>
            </form>
        </div>
    </div>
    {{-- Gestion des médias du film --}}
    <div class="container mx-auto p-6 max-w-lg">
        <h2 class="text-xl font-bold mb-4">📷 Médias du film</h2>

        {{-- Liste des médias existants --}}
        <div class="mb-4">
            <h3 class="font-semibold text-sm text-gray-700 mb-2">Médias actuels</h3>

            @forelse($film->medias as $media)
                <div class="flex justify-between flex-col items-center bg-white border rounded px-3 py-2 mb-2 shadow-sm">
                    <img src="{{ $media->url }}" alt="{{ $media->description }}">
                    <span class="text-sm truncate flex-1">
                        {{ $media->description ?: Str::limit($media->url, 50) }}
                    </span>

                    <form action="{{ route('medias.delete', $media->id) }}"
                          method="POST"
                          class="ml-2"
                          onsubmit="return confirm('Supprimer ce média ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white text-xs px-2 py-1 rounded hover:bg-red-700 transition">
                            🗑️ Supprimer
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-500 italic">Aucun média pour ce film.</p>
            @endforelse
        </div>

        {{-- Formulaire d'ajout --}}
        <div class="bg-white border rounded-lg p-4 shadow-sm">
            <h3 class="font-semibold text-sm text-gray-700 mb-3">Ajouter un nouveau média</h3>

            <form action="{{ route('medias.upload') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-3">
                @csrf

                <input type="hidden" name="film_id" value="{{ $film->id }}">

                <div>
                    <label class="block text-sm font-semibold mb-1">📁 Fichier (optionnel)</label>
                    <input type="file" name="file"
                           class="w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">🔗 URL externe (optionnel)</label>
                    <input type="url" name="url" placeholder="https://example.com/image.jpg"
                           class="w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Pour YouTube, image hébergée ailleurs, etc.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">📝 Description</label>
                    <input type="text" name="description" placeholder="Affiche principale, bande-annonce..."
                           class="w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500">
                </div>

                <button type="submit"
                        class="w-full bg-green-600 text-white font-semibold py-2 rounded hover:bg-green-700 shadow-lg transition">
                    ➕ Ajouter le média
                </button>
            </form>
        </div>
    </div>


@endsection

