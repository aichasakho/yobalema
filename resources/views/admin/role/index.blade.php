@extends('layouts.admin.base')

@section('title', 'Liste Des Roles')

@section('content')

    <div class="py-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@yield('title')</h4>
                <a href="{{ route("admin.role.create") }}" class="btn btn-primary float-end"> Ajouter</a>
            </div>
        <table class="table table-striped">
            <caption class="container">@yield('title')</caption>
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

@endsection
