@extends('layouts.admin.base')

@section('title', 'Liste Des Voitures')

@section('content')

    <div class="py-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                @if(Route::has('admin.voiture.create'))
                    <a href="{{ route("admin.voiture.create") }}" class="btn btn-primary float-end">
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
                    <th>Image voiture</th>
                    <th>Statut</th>
                    <th>Type de voiture</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @isset($voitures)
                @foreach($voitures as $voiture)
                    <tr>
                        <td>{{ $voiture->matricule }}</td>
                        <td>{{ $voiture->date_achat }}</td>
                        <td>{{ $voiture->km_par_defaut }}</td>
                        <td>{{ $voiture->km_actuel }}</td>
                        <td><img src="{{ asset('/storage/'.$voiture->image_voiture) }}" alt="" class="w-50"></td>
                        <td>{{ $voiture->statut }}</td>
                        <td>{{ $voiture->type_de_voiture }}</td>
                        <td>

                            @if(Route::has("admin.voiture.edit"))
                                <a href="{{ route("admin.voiture.edit", $voiture) }}" class="btn btn-primary">
                                    Modifier
                                </a>
                            @endif

                            @if(Route::has("admin.voiture.destroy"))
                                <form action="{{ route("admin.voiture.destroy", $voiture) }}" method="post"
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
                @isset($voitures)
                    {{ $voitures->links() }}
                @endisset
            </div>

        </div>
    </div>

@endsection
