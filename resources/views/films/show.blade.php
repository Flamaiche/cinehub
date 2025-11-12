@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-6 text-center">Détails du Film</h1>

        <div class="w-full md:w-2/3 lg:w-1/2 border rounded-lg shadow p-6 bg-white">
            <x-film-card :film="$film" />

            <div class="flex justify-center gap-4 mt-6">
                <a href="{{ route('films.edit', $film->id) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    ✏️ Modifier
                </a>
                <a href="{{ route('films.index') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    ⬅️ Retour à la liste
                </a>
            </div>
        </div>
    </div>
@endsection
