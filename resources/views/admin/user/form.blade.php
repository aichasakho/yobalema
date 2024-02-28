@extends('layouts.admin.base')

@section('title', 'Formulaire utilisateur')

@section('content')

    <h1>@yield('title')</h1>

    <div class="card">
        <div class="card-header">
            <div class="card-title">@yield('title')</div>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    @include('shared.input', ['name' => "role_user", 'value' =>  $usert->role_user])

                    @include('shared.input',['name' => 'nom', 'value' => $user->nom, 'required' => false,
                        'class' => 'col-md-4' ])

                    @include('shared.input',['name' => 'prenom', 'value' => $user->prenom, 'class' => 'col-md-4'])

                </div>


                @include('shared.input', ['label' => 'Mot de passe', 'name' => 'password',
                        'type' => 'password'])
                @include('shared.input', ['label' => 'Email', 'name' => 'email',
                       'type' => 'email', 'value' => $user->email])

                @include('shared.input', ['label' => "Telephone", 'name' => "telephone", 'value' => $user->telephone])
                @include('shared.input', ['label' => "Adresse", 'name' => "adresse", 'value' =>  $usert->adresse])

</form>
</div>
</div>

@endsection


