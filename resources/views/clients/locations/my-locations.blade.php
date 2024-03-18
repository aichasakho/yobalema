@extends('layouts.client.base')

@section('title', 'Mes Locations')

@section('content')
<div class="bg-secondary" style="height: 100px;"></div>

<div class="container">
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <div class="d-flex justify-content-between">
        <h2 class="align-self-start my-5">Liste mes locations</h2>
    </div>
    <div class="row vsatck gap-3">
        @foreach($locations as $location)
        <div class="card mb-5 col-md-4">
            <div class="card-header">
                <h4 class="card-title">{{ $statut[$location->id] }}</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Départ: {{ $location->heure_depart }}</p>
                <p class="card-text">Arrivée: {{ $location->heure_arrivee ?? 'Non défini' }}</p>
                <p class="card-text">Prix Montant: {{ $location->prix_estime }} Fcfa</p>
                <p class="card-text">Lieu de Départ: {{ $location->lieu_depart }}</p>
                <p class="card-text">Lieu de destination: {{ $location->lieu_destination }}</p>
                <p class="card-text">Chauffeur en charge: {{ $location?->chauffeur?->user?->nom }}</p>
                @if($location->chauffeur_id !== null)
                <form action="{{ route('note.store') }}" method="POST">
                    @csrf
                    @include('shared.input', ['label' => 'Donner une note sur 5',
                    'name' => 'note', 'type' => 'number', 'value' => old('note')])
                    <script>
                        // le maximum de la note est de
                            document.querySelector('input[name="note"]').max = 5
                    </script>
                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Noter</button>
                    </div>
                </form>
                @endif

                @if(!$location->heure_arrivee)

                <p class="card-text">Véhicule: {{ $location->vehicule?->matricule }}</p>
                <form action="{{ route('admin.payement.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @include('shared.input', ['label' => "Indiquer votre moyen de payement",
                    'name' => 'mode', 'type' => 'text', 'value' =>old('mode')])

                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                    <button type="submit" class="btn btn-primary">
                        Payer
                    </button>
                </form>
                <!--supprimer la location en cas d'annulation ou de rejet -->
                <form action="{{ route('admin.location.destroy', ['location' => $location]) }}" method="POST"
                    class="mt-4 needs-validation" novalidate>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Annuler la location
                    </button>
                </form>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
