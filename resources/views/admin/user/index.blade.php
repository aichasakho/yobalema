@extends('layouts.admin.base')

@section('title', 'Liste Des Utilisateurs')

@section('content')

    <div class="py-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">@yield('title')</h4>
                @if(Route::has('admin.user.create'))
                    <a href="{{ route("admin.user.create") }}" class="btn btn-primary float-end">
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
                @isset($users)
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->nom }} {{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telephone }}</td>
                            <td>{{ $user->adresse }}</td>
                            <td>{{ $user->role_user->name ?? 'no role yet' }}</td>
                            <td class="d-flex align-items-center gap-1">

                                @if(Route::has("admin.user.edit"))
                                    <a href="{{ route("admin.user.edit", $user) }}" class="btn btn-primary"
                                       title="Modifier"> <i class="ti ti-pencil"></i>
                                    </a>
                                @endif

                                @if(Route::has("admin.user.destroy"))
                                    <form action="{{ route("admin.user.destroy", $user) }}" method="post"
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
                @isset($users)
                    {{ $users->links() }}
                @endisset
            </div>

        </div>
    </div>

@endsection
