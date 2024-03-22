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
            <h2 class="align-self-start my-5">Liste des locations</h2>
        </div>
        <div class="row vsatck gap-3">
            @foreach($locations as $location)
                <div class="card mb-5 col-md-4">

                    <div class="card-body">
                        <p class="card-text">Départ: {{ $location?->client?->user?->nom }}</p>
                        <p class="card-text">Départ: {{ $location->debut_trajet }}</p>
                        <p class="card-text">Arrivée: {{ $location->fin_trajet ?? 'Non défini' }}</p>
                        <p class="card-text">Montant à payer: {{ $location->prix_du_trajet }} Fcfa</p>
                        <p class="card-text">Lieu de Départ: {{ $location->lieu_depart }}</p>
                        <p class="card-text">Lieu d'arrivée: {{ $location->lieu_d_arrive }}</p>
                        <p class="card-text">Chauffeur en charge: {{ $location?->chauffeur?->user?->nom }}</p>
                        @if($location->chauffeur_id !== null)
                            <form action="{{ route('commentaire.store') }}" method="POST">
                                @csrf
                                @include('shared.input', ['label' => 'Commentaires pour le conducteur',
                                'name' => 'commentaire', 'type' => 'text', 'value' => old('commentaire')])
                                <script>
                                    // le maximum de la note est de
                                    document.querySelector('input[name="commenter"]').max = 100
                                </script>
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Commenter</button>
                                </div>
                            </form>
                        @endif

                        @if(!$location->fin_trajet)

                            <p class="card-text">Voiture: {{ $location->voiture?->matricule }}</p>
                            <form action="{{ route('admin.payement.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                {{--@include('shared.input', ['label' => "Mode de paiement:",
                                'name' => 'mode', 'type' => 'text', 'value' =>old('mode')])
                                --}}
                                <div>
                                    <label for="mode">Mode de paiement:</label>
                                    <select name="mode" id="mode">
                                        <option value="carte">Carte de crédit</option>
                                        <option value="paypal">PayPal</option>
                                        <!-- Ajoutez d'autres options de paiement si nécessaire -->
                                    </select>
                                </div>

                                <!-- Bouton de soumission -->
                                <button type="submit">Valider le paiement</button>

                                <input type="hidden" name="location_id" value="{{ $location->id }}">

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
