@extends('layouts.client.base')

@section('title', "Accueil")

@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>

    <div class="hero-wrap ftco-degree-bg" style="background-image: url('{{asset('clients/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center mb-md-5 pb-md-5">
                        <h1 class="mb-4">Un moyen rapide et facile de louer une voiture</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">
                            <form action="{{ route('admin.location.store') }}" class="request-form ftco-animate bg-primary" novalidate method="POST">
                                @csrf
                                <h2>Réservez maintenant <a href="#" class="ml-auto btn btn-primary"></a></h2>

                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    @include('shared.select', ['name' => 'voiture_id', 'label'=>'Type de voiture',
                                     'value' => old('voiture_id'), 'options' => $type_de_voiture,'class' => 'text-light'])

                                </div>
                                <div class="form-group">
                                    @include('shared.input', ['name' => 'lieu_depart', 'label' => 'Lieu de Départ',
                                      'value' => old('lieu_depart'),'class' => 'text-light'])
                                </div>
                                <div class="form-group">
                                    @include('shared.input', ['name' => 'lieu_d_arrive', 'label' => 'Lieu d\'arrivé',
                                      'value' => old('lieu_d_arrive'),'class' => 'text-light'])
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mr-2">
                                        <script>
                                            document.getElementById('date').min = new Date().toISOString().split('T')[0];
                                        </script>
                                    </div>

                                </div>
                                <div>
                                    <div class="form-group">
                                        @include('shared.input', ['type'=>'datetime-local', 'name' => 'debut_trajet',
                                  'label' => 'Début du trajet',  'value' => old('debut_trajet'),'class' => 'text-light'])
                                    </div>
                                    <div class="form-group">
                                        @include('shared.input', ['type' => 'date', 'name' => 'date',
                                'label' => 'Date de location',  'value' => old('date'),'class' => 'text-light'])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Commandez" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Une meilleure façon de louer votre voiture parfaite</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Choisissez votre lieu de prise en charge</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Sélectionnez la meilleure offre</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Réservez votre voiture de location</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="{{ route('afficherVoiture') }}" class="btn btn-primary py-3 px-4">Réservez la voiture de vos rêves</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Nos Offres</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/car-1.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">20000F<span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/voiture2.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">FORD</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">25000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/voiture3.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">TOYOTA</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">30000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/camion1.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">BouMagg Bi</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">50000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/camion2.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Ndimal Ndiabot</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">60000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/camion3.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Grand Camion</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">65000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/bus1.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Mercedes Grand Sedan</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">45000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/bus2.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Bus confortable</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">40000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="car-wrap rounded ftco-animate">
                                <div class="img rounded d-flex align-items-end" style="background-image: url('{{asset('clients/images/bus3.jpg')}}');">
                                </div>
                                <div class="text">
                                    <h2 class="mb-0"><a href="#">Grand Bus</a></h2>
                                    <div class="d-flex mb-3">
                                        <p class="price ml-auto">45000F <span>/jour</span></p>
                                    </div>
                                    <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Louez maintenant</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="map"></div>



    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="60">0</strong>
                            <span>Year <br>Experienced</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1090">0</strong>
                            <span>Total <br>Cars</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="2590">0</strong>
                            <span>Happy <br>Customers</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Total <br>Branches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


    <script>

        // Initialiser la carte
        var map = L.map('map').setView([51.505, -0.09], 13);

        // Ajouter une couche de tuiles de la carte (par exemple, OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Récupérer les coordonnées géographiques depuis Nominatim
        var latitude = 48.8566; // Coordonnées de latitude
        var longitude = 2.3522; // Coordonnées de longitude

        // Ajouter un marqueur à la position
        L.marker([latitude, longitude]).addTo(map);
    </script>











    {{--<div id="map" style="height: 400px;"></div>

    <script>
         /*// Code d'initialisation de la carte avec Leaflet
        var map = L.map('map').setView([{{ $departResult['lat'] }}, {{ $departResult['lon'] }}], 12);


        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([{{ $departResult['lat'] }}, {{ $departResult['lon'] }}]).addTo(map);

        // Fonction pour mettre à jour la localisation en temps réel
        function updateLocation() {
            // Effectuer une requête AJAX pour récupérer les nouvelles coordonnées géographiques depuis Nominatim
            $.ajax({
                url: '/update-location', // Remplacez l'URL par l'endpoint de votre route Laravel
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Mettre à jour la position du marqueur sur la carte avec les nouvelles coordonnées
                    var latitude = response.latitude;
                    var longitude = response.longitude;
                    // ... Code pour mettre à jour la position du marqueur sur la carte ...
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Mettre à jour la localisation toutes les 5 secondes
        setInterval(updateLocation, 5000);

        // Définir une fonction pour mettre à jour la position du marqueur sur la carte
        function updateMarkerPosition(latitude, longitude) {
            marker.setLatLng([latitude, longitude]);
        }

        // À l'endroit approprié dans votre code
        updateMarkerPosition({{ $departResult['lat'] }}, {{ $departResult['lon'] }});
*/

    </script>--}}


@endsection
