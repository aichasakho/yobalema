@extends('layouts.admin.base')

@section('title', 'Page utilisateurs')

@section('content')

    <h1>@yield('title')</h1>

    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Ajouter</a>

    <!-- TODO: AFFicher la listes de tous les utilisateurs -->

    @foreach($users as $user)

    @endforeach

@endsection




    {{--<div class="py-12">
        <div class="card col-md-8 m-auto">
            <div class="card-header">
                <a href="{{ route("admin.role.create") }}" class="btn btn-primary"> Ajouter</a>
            </div>
            <table class="table table-striped">
                <thead class="table-header-group">
                <tr>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a href="{{ route("admin.role.edit", $role) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route("admin.role.destroy", $role) }}" method="post"
                                  class="needs-validation d-inline" novalidate>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

--}}
