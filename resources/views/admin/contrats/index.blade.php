@extends('layouts.admin.base')

@section('title', 'Contrats')

@section('content')
    <div class="d-flex  justify-content-between">
        <h2 class="align-self-start">Liste des contrats</h2>
        <a href="{{ route('admin.contrat.create') }}" class="btn btn-primary">Ajouter</a>
    </div>
    <div class="container mt-3">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-header-group">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Prenoms et noms</th>
                    <th scope="col">Permis</th>
                    <th scope="col">Salaire</th>
                    <th scope="col">Date d'embauche</th>
                    <th scope="col">Type de contrat</th>
                    <th scope="col">Duree du contrat</th>
                    <th scope="col">Etat du contrat</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="table-body">
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->contrats?->id }}</td>
                        <td>{{ $user->nom }} {{ $user->prenom }}</td>
                        <td>{{ $user->chauffeurs?->num_permis }}</td>
                        <td>{{ $user->contrats?->salaire}}</td>
                        <td>{{ $user->contrats?->date_embauche }}</td>
                        <td>{{ $user->contrats?->type_contrat }}</td>
                        <td>{{ $user->contrats?->duree_contrat }}</td>
                        <td>{{ $user->contrats?->etat_contrat ? 'Actif' : 'Inactif' }}</td>
                        <td>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="{{ route('admin.contrat.edit', $user->contrats) }}" class="btn btn-primary"><i class="ti ti-pencil"></i></a>
                                <form action="{{ route('admin.contrat.destroy', $user->contrats) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"> <i class="ti ti-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

@endsection

