@extends('layouts.admin.base')

@section('title', 'afficher la location')

@section('content')
    <h1>Details de la location</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.location.index') }}" class="btn btn-danger">Retour</a>
    </div>
@endsection
