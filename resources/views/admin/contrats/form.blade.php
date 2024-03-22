@extends('layouts.admin.base')

@section('title', $contrat->exists ? 'Modifier le contrat' : 'Ajouter un contrat')

@section('content')
    <h1>@yield('title')</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.contrat.index') }}" class="btn btn-outline-primary">Retour</a>
    </div>
    <div>
        <form action="{{ route('admin.contrat.store') }}" method="Post">
            @csrf
            @method($contrat->exists ? "PUT" : "POST")

            @include('shared.select', ['label' => 'Chauffeur', 'name' => 'user_id', 'value' => $contrat->chauffeur_id, 'options' => $chauffeurs, 'required' => true])

            @include('shared.select', ['label' => 'Type de contrat', 'name' => 'type_contrat', 'value' => $contrat->type_contrat, 'options' => $type_contrats, 'required' => true])

            @include('shared.input', ['label' => 'Duree du contrat', 'name' => 'duree_contrat', 'type' => 'number', 'value' => $contrat->duree_contrat, 'required' => true])

            @include('shared.input', ['label' => 'Salaire', 'name' => 'salaire', 'type' => 'number', 'value' => $contrat->salaire, 'required' => true])

            @include('shared.input', ['label' => 'Date d\'embauche', 'name' => 'date_embauche', 'type' => 'date', 'value' => $contrat->date_embauche, 'required' => true])

            <!--ajout d'un button qui permet de changer l'etat du contrat -->
            <div class="form-group mt-3">
                <label for="etat_contrat" class="form-label">Etat du contrat </label><br>
                    <span class="mr-4">
                        <input type="radio" name="etat_contrat" value="1" @if($contrat->etat_contrat == 1) checked @endif> Actif
                    </span>
                    <span class="ml-3">
                        <input type="radio" name="etat_contrat" value="0" @if($contrat->etat_contrat == 0) checked @endif> Inactif
                    </span>
            </div>
            <button type="submit" class="btn btn-primary mt-3">@if($contrat->exists) Modifier le contrat @else @yield('title') @endif </button>
        </form>
    </div>
    @if(! $contrat->exists)
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.contrat.index') }}" class="link-primary">Creer plus tard ?</a>
    </div>
    @endif
@endsection
