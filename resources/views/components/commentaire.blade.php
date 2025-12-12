<div class="border p-4 rounded-lg mb-4 bg-gray-50">
    <p class="font-semibold">{{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}</p>
    <p class="text-gray-700">{{ $commentaire->contenu }}</p>
    @if($commentaire->note)
        <p class="text-sm text-yellow-600">Note : {{ $commentaire->note }}/10</p>
    @endif
</div>
