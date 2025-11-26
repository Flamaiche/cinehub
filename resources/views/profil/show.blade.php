@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Mon profil</h1>

        <div class="bg-white shadow-md rounded-lg p-6 space-y-3">
            <p><span class="font-semibold text-gray-700">Nom :</span> {{ $user->nom ?? '' }}</p>
            <p><span class="font-semibold text-gray-700">Prénom :</span> {{ $user->prenom ?? '' }}</p>
            <p><span class="font-semibold text-gray-700">Email :</span> {{ $user->email }}</p>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <a href="{{ route('profil.edit') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Modifier le profil
            </a>

            <form method="POST" action="{{ route('profil.destroy') }}"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Supprimer mon compte
                </button>
            </form>
        </div>
    </div>
@endsection
