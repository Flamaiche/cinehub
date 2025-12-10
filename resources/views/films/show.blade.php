@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 flex flex-col items-center">
        <h1 class="text-3xl font-bold mb-6 text-center">Détails du Film</h1>

        <div class="w-full md:w-2/3 lg:w-1/2 border rounded-lg shadow p-6 bg-white">
            <x-film-card :film="$film" />

            {{-- Genres --}}
            <h2 class="font-semibold mt-6 mb-2">Genres</h2>
            @if($film->genres->isEmpty())
                <p class="text-sm text-gray-500">Aucun genre renseigné.</p>
            @else
                <p class="mb-4">
                    @foreach($film->genres as $genre)
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                            {{ $genre->nom }}
                        </span>
                    @endforeach
                </p>
            @endif
            {{-- Médias --}}
            <h2 class="text-xl font-bold mt-6 mb-3">Médias</h2>
            @if($film->medias->isEmpty())
                <p class="text-sm text-gray-500 italic">Aucun média pour ce film.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($film->medias as $media)
                        @php
                            $isExternal = str_starts_with($media->url, 'http');
                            $src = $isExternal
                                ? $media->url
                                : \Illuminate\Support\Facades\Storage::disk('public')->url($media->url);
                        @endphp

                        <div class="border rounded-lg shadow-md p-3 bg-gray-50">
                            <img src="{{ $src }}"
                                 alt="{{ $media->description ?? 'Média du film' }}"
                                 class="w-full h-48 object-cover rounded-md mb-2">

                            @if($media->description)
                                <p class="text-sm text-gray-700 mb-2">{{ $media->description }}</p>
                            @endif

                            @auth
                                <form action="{{ route('medias.delete', $media->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer ce média ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-700 transition">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            @endauth
                        </div>
                    @endforeach
                </div>
            @endif


            {{-- Acteurs avec rôle + note --}}
            <h2 class="font-semibold mt-4 mb-2">Acteurs</h2>
            @if($film->acteurs->isEmpty())
                <p class="text-sm text-gray-500">Aucun acteur renseigné.</p>
            @else
                <ul class="space-y-1 mb-4">
                    @foreach($film->acteurs as $acteur)
                        <li>
                            <span class="font-semibold">
                                {{ $acteur->nom }}
                            </span>
                            – rôle : {{ $acteur->pivot->role }}
                            – note : {{ $acteur->pivot->note }}/10
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="flex justify-center mt-6">
                <a href="{{ route('films.index') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    ⬅️ Retour à la liste
                </a>
            </div>
        </div>
    </div>
@endsection
