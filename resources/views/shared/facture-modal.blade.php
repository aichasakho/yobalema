@php/* @var App\Models\Location  $location */@endphp
    <!-- Vertically centered Modal -->
<button type="button" class="btn btn-sm btn-secondary "
        data-bs-toggle="modal" data-bs-target="#modal-location-{{ $id }}">
    {{ $title }} <i class="bi bi-car-front-fill"></i>
</button>
<div class="modal fade" id="modal-location-{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-8">

                        <p class="card-text">
                            <span class="fw-bold">Client: </span>{{  $location?->client?->nom }}
                        </p>

                        <p class="card-text">
                            <span class="fw-bold">Départ: </span>{{ $location->debut_trajet }}
                        </p>

                        <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>Arrivée: </span>{{ $location->fin_trajet ?? 'Non défini' }}
                        </p>

                        <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>Montant à payer: </span>{{ round($location->prix_du_trajet) }} Fcfa
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Lieu de Départ: </span>{{ $location->lieu_depart }}
                        </p>
                        <p class="card-text">
                            <span class="fw-bold">Lieu d'arrivée: </span>{{ $location->lieu_d_arrive }}
                        </p>

                        <p class="card-text">
                            <span class="fw-bold">Chauffeur en charge: </span>{{ $location?->chauffeur?->user?->nom }}
                        </p>
                    </div><!-- End Col -->
                </div> <!-- End Row -->

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-sm btn-secondary" onclick="window.location='{{ route('facture.download', ['id' => $id]) }}'">
                    Télécharger la facture <i class="bi bi-download"></i>
                </button>

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                    Fermer <i class="bi bi-x"></i>
                </button>

            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->


