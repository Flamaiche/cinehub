@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Mon profil</h1>

        {{-- Informations utilisateur --}}
        <div class="bg-white shadow-md rounded-lg p-6 space-y-3">
            <p><span class="font-semibold text-gray-700">Nom :</span> {{ $user->nom ?? '' }}</p>
            <p><span class="font-semibold text-gray-700">Prénom :</span> {{ $user->prenom ?? '' }}</p>
            <p><span class="font-semibold text-gray-700">Email :</span> {{ $user->email }}</p>
        </div>

        {{-- Actions utilisateur --}}
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

        {{-- Section Commentaires --}}
        <h2 class="text-2xl font-bold mt-10 mb-4">Mes commentaires</h2>

        @if($user->commentaires->isEmpty())
            <p class="text-gray-500 italic">Vous n'avez encore soumis aucun commentaire.</p>
        @else
            <ul class="space-y-4">
                @foreach($user->commentaires as $commentaire)
                    <li class="bg-gray-50 border border-gray-200 rounded p-4 shadow-sm">
                        <p class="text-gray-800">{{ $commentaire->contenu }}</p>
                        @if($commentaire->note)
                            <p class="text-sm text-gray-600">Note : {{ $commentaire->note }}/10</p>
                        @endif
                        <p class="text-xs text-gray-400">
                            Statut :
                            @if($commentaire->statut === 'valide')
                                ✅ Validé
                            @elseif($commentaire->statut === 'en_attente')
                                ⏳ En attente
                            @elseif($commentaire->statut === 'supprime')
                                ❌ Supprimé
                            @endif
                            – Soumis le {{ $commentaire->created_at->format('d/m/Y H:i') }}
                        </p>

                        <div class="mt-2 flex gap-2 flex-wrap">
                            {{-- Options utilisateur --}}
                            @if(auth()->id() === $user->id && $commentaire->statut !== 'supprime')
                                <a href="{{ route('commentaires.edit', $commentaire->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Modifier</a>

                                <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce commentaire ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Supprimer</button>
                                </form>
                            @endif

                            {{-- Options admin --}}
                            @if(auth()->check() && auth()->user()->isAdmin())
                                @if($commentaire->statut === 'en_attente')
                                    <form action="{{ route('commentaires.updateStatut', $commentaire->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700">
                                            Valider
                                        </button>
                                    </form>
                                @endif

                                @if($commentaire->statut !== 'supprime')
                                    <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST"
                                          onsubmit="return confirm('Supprimer ce commentaire ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">
                                            Supprimer
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
