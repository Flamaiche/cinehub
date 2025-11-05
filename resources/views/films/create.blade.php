@extends('layouts.app')

@section('title', 'Ajouter un film')

@section('content')
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Ajouter un nouveau film</h1>

        {{-- Erreurs de validation --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Oups !</strong> Des erreurs sont survenues :
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('films.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="titre" class="block text-sm font-semibold text-gray-700">Titre du film</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1"
                       placeholder="Ex : Inception" required>
            </div>

            <div>
                <label for="date_sortie" class="block text-sm font-semibold text-gray-700">Date de sortie</label>
                <input type="date" name="date_sortie" id="date_sortie" value="{{ old('date_sortie') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1">
            </div>

            <div>
                <label for="synopsis" class="block text-sm font-semibold text-gray-700">Synopsis</label>
                <textarea name="synopsis" id="synopsis" rows="4"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1"
                          placeholder="Résumé du film...">{{ old('synopsis') }}</textarea>
            </div>

            <div>
                <label for="duree" class="block text-sm font-semibold text-gray-700">Durée (en minutes)</label>
                <input type="number" name="duree" id="duree" value="{{ old('duree') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1"
                       placeholder="Ex : 120" required>
            </div>

            <div>
                <label for="note" class="block text-sm font-semibold text-gray-700">Note sur 5</label>
                <input type="number" name="note" id="note" value="{{ old('note') }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1"
                       min="0" max="5" step="0.1" placeholder="Ex : 4.5">
            </div>

            <div class="flex justify-between items-center mt-8">
                <a href="{{ route('films.index') }}"
                   class="text-gray-600 hover:text-gray-800 transition">⟵ Retour à la liste</a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
@endsection
