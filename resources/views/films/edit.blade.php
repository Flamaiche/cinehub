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

            <input type="url" name="media" placeholder="URL de l'affiche" value="{{ old('media', $film->media) }}"
                   class="w-full border rounded px-2 py-1">

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                Mettre à jour
            </button>
        </form>
    </div>
@endsection
