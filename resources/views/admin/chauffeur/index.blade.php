@extends('layouts.admin.base')
@section('title', 'Liste des chauffeurs')

@section('content')
<div class="d-flex justify-content-between">
    <h2>@yield('title')</h2>
    <a href="{{ route("admin.chauffeur.create") }}" class="btn btn-primary"> Ajouter</a>
</div>
<div class="py-12">
    <div class="m-auto card">
        <div class="table-responsive">
            <table class="table table-striped text-nowrap">
                <thead class="table-header-group">
                    <tr>
                        <th>#</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Numéro de Permis</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Date Délivrance</th>
                        <th scope="col">Date Expiration</th>
                        <th scope="col">Annee Expérience</th>
                        <th scope="col">Vehicule</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <img src="{{ asset('/storage/'.$user->chauffeurs?->image) }}" class="rounded"
                                alt="Chauffeur Avatar" width="100" height="100">
                        </td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td>{{ $user->adresse }}</td>
                        <td>{{ $user->chauffeurs?->num_permis }}</td>
                        <td>{{ $user->chauffeurs?->categorie }}</td>
                        <td>{{ $user->chauffeurs?->date_delivrance }}</td>
                        <td>{{ $user->chauffeurs?->date_expiration }}</td>
                        <td>{{ $user->chauffeurs?->annee_experience }}</td>
                        <td>{{ $user->chauffeurs?->vehicule?->matricule ?? "PAs de vehicule attribue" }}</td>
                        <td>
                            <form action="{{ route("admin.chauffeur.addVehicule", $user->chauffeurs) }}" method="post"
                                class="needs-validation d-inline" novalidate>
                                @csrf
                                <button type="submit" class="btn btn-success">Assigner un vehicule</button>
                            </form>
                            <a href="{{ route("admin.chauffeur.edit", $user->chauffeurs) }}"
                                class="btn btn-primary"><i class="ti ti-pencil"> </i></a>
                            <form action="{{ route("admin.chauffeur.destroy", $user->chauffeurs) }}" method="post"
                                class="needs-validation d-inline" novalidate>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"> <i class="ti ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
