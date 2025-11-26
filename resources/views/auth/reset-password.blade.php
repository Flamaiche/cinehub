@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-md p-6">
        <h1 class="text-2xl font-bold mb-4 text-center">Modifier le mot de passe</h1>

        <form method="POST" action="{{ route('password.update') }}">
        @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                       class="w-full border rounded px-3 py-2">
                @error('email')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" required
                       class="w-full border rounded px-3 py-2">
                @error('password')
                <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block mb-1 font-semibold">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                Réinitialiser le mot de passe
            </button>
        </form>
    </div>
@endsection
