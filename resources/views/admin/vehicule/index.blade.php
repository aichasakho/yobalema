@extends('layouts.admin.base')

@section('title', 'Liste Des Véhicules')

@section('content')

    <div class="py-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                @if(Route::has('admin.vehicule.create'))
                    <a href="{{ route("admin.vehicule.create") }}" class="btn btn-primary float-end">
                        Ajouter
                    </a>
                @endif
            </div>
            <table class="table table-striped">
                <caption class="container">@yield('title')</caption>
                <thead class="table-header-group">
                <tr>
                    <th>Matricule</th>
                    <th>Date Achat</th>
                    <th>Kilométre par défaut</th>
                    <th>Kilométre actuel</th>
                    <th>Statut</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @isset($vehicules)
                @foreach($vehicules as $vehicule)
                    <tr>
                        <td>{{ $vehicule->matricule }}</td>
                        <td>{{ $vehicule->date_achat }}</td>
                        <td>{{ $vehicule->km_defaut }}</td>
                        <td>{{ $vehicule->km_actuel }}</td>
                        <td>{{ $vehicule->statut }}</td>
                        <td>{{ $vehicule->categorie }}</td>
                        <td>

                            @if(Route::has("admin.vehicule.edit"))
                                <a href="{{ route("admin.vehicule.edit", $vehicule) }}" class="btn btn-primary">
                                    Modifier
                                </a>
                            @endif

                            @if(Route::has("admin.vehicule.destroy"))
                                <form action="{{ route("admin.vehicule.destroy", $vehicule) }}" method="post"
                                      class="d-inline">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger"
                                            onclick="event.preventDefault();this.closest('form').submit();">
                                        Supprimer
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @endisset
                </tbody>

            </table>
            <div class="container">
                @isset($vehicules)
                    {{ $vehicules->links() }}
                @endisset
            </div>

        </div>
    </div>

@endsection
