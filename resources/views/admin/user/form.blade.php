@extends('layouts.admin.base')

@section('title', 'Formulaire Des Utilisateurs')

@section('content')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>@yield('title')</h4>
            </div>
            <div class="card-body">
                @if(Route::has(['admin.user.update', 'admin.user.store']))
                    <form method="post" class="needs-validation vstack gap-2"
                         action="{{ route(
                                    $user->exists
                                    ? 'admin.user.update'
                                    : 'admin.user.store',
                                    $user
                                )
                         }}"
                        enctype="multipart/form-data" novalidate >

                        @csrf
                        @method($user->exists ? "PUT" : "POST")

                        <div class="row">

                            @include('shared.input', ['name' => "nom", 'value' => $user->nom, 'class' => 'col-md-6'])

                            @include('shared.input', ['label' => 'Prénom', 'name'=> 'prenom',
                                    'value' => $user->prenom, 'class' => 'col-md-6'])
                        </div>

                        <div class="row">
                            @include('shared.input', ['name' => 'password', 'type' => 'password',
                                'label' => 'Mot de passe', 'class' => 'col-md-6'])

                            @include('shared.input', ['name' => 'confirm_password', 'type' => 'password',
                                'label' => 'Confirmer le mot de passe', 'class' => 'col-md-6'])
                        </div>

                        @include('shared.input', ['name' => 'email', 'value' => $user->email, 'type' => 'email'])

                        <div class="row">
                            @include('shared.input', ['name' => 'telephone', 'value' => $user->telephone,
                                'class' => 'col-md-6'])

                            @include('shared.input', ['name' => 'adresse', 'value' => $user->adresse,
                                'class' => 'col-md-6'])
                        </div>

                        @include('shared.select', ['name' => 'role_user_id', 'value' => $user->role_user_id,
                            'label' => 'Role', 'options' => $roles ])

                        <button type="submit" class="btn btn-primary">
                            @if($user->exists)
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
