@extends('layouts.admin.base')

@section('title', 'Formulaire Des Véhicules')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="card-body">
                @if(Route::has(['admin.vehicule.update', 'admin.vehicule.store']))

                    <form
                        method="post"
                        class="needs-validation vstack gap-2"
                        action="{{ route($vehicule->exists
                                ? 'admin.vehicule.update'
                                : 'admin.vehicule.store',
                                 $vehicule)
                        }}"
                        enctype="multipart/form-data" novalidate
                    >

                        @csrf
                        @method($vehicule->exists ? "PUT" : "POST")

                        @includeUnless($vehicule->exists, 'shared.input', ['required' => false,
                            'label' => 'Image', 'name' => 'image_vehicule', 'type' => 'file'])

                        @include('shared.input', ['name' => "matricule", 'value' => $vehicule->matricule])


                        <div class="row">
                            @include('shared.input', ['label' => 'Date Achat', 'name'=> 'date_achat',
                                    'type' => 'date', 'value' => $vehicule->date_achat, 'class' => 'col-md-6'])


                            @include('shared.input', ['label' => 'Km Défaut', 'name' => 'km_defaut', 'type' => 'number',
                                    'value' => $vehicule->km_defaut, 'class' => 'col-md-6'])
                        </div>

                        <div class="row">
                            @include('shared.select', ['name' => 'statut', 'options' => $statuts,
                                'value' => $vehicule->statut, 'class' => 'col-md-6'])
                            @include('shared.select', ['name' => 'categorie', 'options' => $categories,
                                'value' => $vehicule->categorie, 'class' => 'col-md-6'])
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if($vehicule->exists)
                                Modifier
                            @else
                                Creer
                            @endif
                        </button>

                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
