@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Liste des Films</h1>

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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($films as $film)
                <div class="border rounded-lg shadow p-4">
                    <x-film-card :film="$film" />
                    <div class="mt-4 text-center">
                        <a href="{{ route('films.edit', $film->id) }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            ✏️ Modifier
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">Aucun film trouvé.</p>
            @endforelse
        </div>
    </div>
@endsection
