@php/* @var App\Models\Voiture  $voiture  */@endphp


    <!-- Vertically centered Modal -->
<button type="button" class="btn btn-sm btn-primary "
        data-bs-toggle="modal" data-bs-target="#modal-voiture-{{ $id }}">
    {{ $title }} <i class="bi bi-car-front-fill"></i>
</button>
<div class="modal fade" id="modal-voiture-{{ $id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{asset('/storage/'.$voiture->image_voiture) }}"
                                 class="img-fluid w-100 rounded" alt="Photo voiture">
                        </div><!-- End Img col -->
                        <div class="col-md-8">
                            <p class="card-text">
                                <span class="fw-bold">Matricule: </span>{{ $voiture->matricule }}
                            </p>

                            <p class="card-text">
                                <span class="fw-bold">Date d'achat: </span>{{ $voiture->date_achat }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>Km par défaut: </span>{{ $voiture->km_par_defaut }} km
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">
                                    <i class="bi bi-speedometer"></i>Km actuel: </span>{{ $voiture->km_actuel }} km
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Status: </span>{{ $voiture->statut }}
                            </p>
                            <p class="card-text">
                                <span class="fw-bold">Catégorie </span>{{ $voiture->type_de_voiture}}
                            </p>
                        </div><!-- End Col -->

                        <div class="col-md-4">
                            @if(isset($chauffeur))
                                <span class="fw-bold">Chauffeur en charge: </span>
                                <img src="{{ asset('/storage/'.$chauffeur->image) }}" class="img-fluid w-100 rounded" alt="Photo chauffeur">
                            @endif
                        </div>
                    </div> <!-- End Row -->

            </div>
            {{--<div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        Fermer <i class="bi bi-x"></i>
                    </button>

            </div>--}}
        </div>
    </div>
</div><!-- End Vertically centered Modal-->


