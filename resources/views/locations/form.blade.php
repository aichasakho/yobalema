
@extends('layouts.admin.base')

@section('title', $location->exists ? 'Modifier la location' : 'Ajouter une location')

@section('content')
    <h1>@yield('title')</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.location.index') }}" class="btn btn-danger">Retour</a>
    </div>
@endsection
