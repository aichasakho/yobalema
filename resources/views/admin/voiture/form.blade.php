@extends('layouts.admin.base')

@section('title', 'Formulaire Des Voitures')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="card-body">
                @if(Route::has(['admin.voiture.update', 'admin.voiture.store']))

                    <form
                        method="post"
                        class="needs-validation vstack gap-2"
                        action="{{ route($voiture->exists
                                ? 'admin.voiture.update'
                                : 'admin.voiture.store',
                                 $voiture)
                        }}"
                        enctype="multipart/form-data" novalidate
                    >

                        @csrf
                        @method($voiture->exists ? "PUT" : "POST")

                        @includeUnless($voiture->exists, 'shared.input', ['required' => false,
                            'label' => 'Image', 'name' => 'image_voiture', 'type' => 'file'])

                        @include('shared.input', ['name' => "matricule", 'value' => $voiture->matricule])


                        <div class="row">
                            @include('shared.input', ['label' => 'Date d\'chat', 'name'=> 'date_achat',
                                    'type' => 'date', 'value' => $voiture->date_achat, 'class' => 'col-md-6'])


                            @include('shared.input', ['label' => 'Km par défaut', 'name' => 'km_par_defaut', 'type' => 'number',
                                    'value' => $voiture->km_par_defaut, 'class' => 'col-md-6'])
                        </div>

                        <div class="row">
                            @include('shared.select', ['name' => 'statut', 'options' => $statuts,
                                'value' => $voiture->statut, 'class' => 'col-md-6'])
                            @include('shared.select', ['name' => 'type_de_voiture', 'options' => $type_de_voiture,
                                'value' => $voiture->type_de_voiture, 'class' => 'col-md-6'])
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if($voiture->exists)
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
