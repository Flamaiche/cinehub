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

        <div class="text-center mb-6 flex justify-center">
            <a href="{{ route('films.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white p-2 rounded">Ajouter un film</a>
        </div>

        <!-- Liste des films -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($films as $film)
                <x-film-card :film="$film" />
            @empty
                <p class="text-center text-gray-500 col-span-full">Aucun film trouvé.</p>
            @endforelse
        </div>
    </div>
@endsection
