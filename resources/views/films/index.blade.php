@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">🎬 Liste des Films</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($films as $film)
                <x-film-card :film="$film" />
            @endforeach
        </div>
    </div>
@endsection
