@extends('layouts.client.base')

@section('title', 'Liste des locations')

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
                    <div class="card-header">
                        <h4 class="card-title">Payement</h4>
                    </div>

                    <div class="card-body w-250 ">

                        @if(!$location->fin_trajet)


                          <p class="card-text">Voiture: {{ $location->voiture?->matricule }}</p>
                            <form action="{{ route('admin.payement.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf

                                @include('shared.select', ['label' => "Mode de paiement:",'name' => 'mode', 'options' => $modes,
                                'value' => $location->mode])

                                <!-- Bouton de soumission -->
                                <button type="submit" class="btn btn-secondary">Valider le paiement</button>

                                <input type="hidden" name="location_id" value="{{ $location->id }}">

                            </form>
                        @endif


                        @if($location->chauffeur_id !== null)
                            <form action="{{ route('commentaire.store') }}" method="POST">
                                @csrf
                                @include('shared.input', ['label' => 'Commentaires pour le conducteur', 'required' => false,
                                'name' => 'commentaire', 'type' => 'text', 'value' => old('commentaire')])
                                <script>
                                    // le maximum de la note est de
                                    document.querySelector('input[name="commenter"]').max = 100
                                </script>
                                <input type="hidden" name="location_id" value="{{ $location->id }}">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-secondary">Commenter</button>
                                    @endif

                                            @include('shared.facture-modal', [
                                           'id' => $location->id,
                                           'title' => __('Voir facture'),
                                           'location' => $location,
                                       ])
                                </div>



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


                    </div>


                </div>
            @endforeach
        </div>
    </div>
@endsection
