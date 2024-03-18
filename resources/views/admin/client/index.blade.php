@extends('layouts.admin.base')

@section('title', 'Liste Des Clients')

@section('content')

    <div class="py-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                @if(Route::has('admin.client.create'))
                    <a href="{{ route("admin.client.create") }}" class="btn btn-primary float-end">
                        Ajouter
                    </a>
                @endif
            </div>
            <table class="table table-striped">
                <caption class="container">@yield('title')</caption>
                <thead class="table-header-group">
                <tr>
                    <th>Nom</th>
                    <th>email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @isset($clients)
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->nom }} {{ $client->prenom }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->telephone }}</td>
                            <td>{{ $client->adresse }}</td>
                            <td>{{ $client->role_user->name ?? 'no role yet' }}</td>
                            <td class="gap-1 d-flex align-items-center">

                                @if(Route::has("admin.client.edit"))
                                    <a href="{{ route("admin.client.edit", $client) }}" class="btn btn-primary"
                                       title="Modifier"> <i class="ti ti-pencil"></i>
                                    </a>
                                @endif

                                @if(Route::has("admin.client.destroy"))
                                    <form action="{{ route("admin.client.destroy", $client) }}" method="post"
                                          class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger" title="Supprimer"
                                                onclick="confirm('Confirmer le suppression')
                                                ? this.closest('form').submit()
                                                : event.preventDefault()"
                                        >
                                            <i class="ti ti-trash"></i>
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
                @isset($clients)
                    {{ $clients->links() }}
                @endisset
            </div>

        </div>
    </div>

@endsection
