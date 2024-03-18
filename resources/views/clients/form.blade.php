@extends('layouts.client.base')

@section('title',  $client->exists ? "Modifier d'un Client" : 'Ajouter un client')

@section('content')
    <div class="bg-secondary" style="height: 100px;"></div>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="card-body">
                @if(Route::has(['admin.client.update', 'admin.client.store']))
                    <form method="post" class="gap-2 needs-validation vstack"
                          action="{{ route(
                                    $client->exists
                                    ? 'admin.client.update'
                                    : 'admin.client.store',
                                    $client
                                )
                         }}"
                          enctype="multipart/form-data" novalidate >

                        @csrf
                        @method($client->exists ? "PUT" : "POST")

                        <div class="row">

                            @include('shared.input', ['name' => "nom", 'value' => $client->nom, 'class' => 'col-md-6'])

                            @include('shared.input', ['label' => 'Prénom', 'name'=> 'prenom',
                                    'value' => $client->prenom, 'class' => 'col-md-6'])
                        </div>

                        <div class="row">
                            @include('shared.input', ['name' => 'password', 'type' => 'password',
                                'label' => 'Mot de passe', 'class' => 'col-md-6'])

                            @include('shared.input', ['name' => 'confirm_password', 'type' => 'password',
                                'label' => 'Confirmer le mot de passe', 'class' => 'col-md-6'])
                        </div>

                        @include('shared.input', ['name' => 'email', 'value' => $client->email, 'type' => 'email'])

                        <div class="row">
                            @include('shared.input', ['name' => 'telephone', 'value' => $client->telephone,
                                'class' => 'col-md-6'])

                            @include('shared.input', ['name' => 'adresse', 'value' => $client->adresse,
                                'class' => 'col-md-6'])
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @if($client->exists)
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
