@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-md p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Réinitialiser le mot de passe</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border rounded px-3 py-2">
                @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                Envoyer le lien de réinitialisation
            </button>
        </form>
    </div>
@endsection
