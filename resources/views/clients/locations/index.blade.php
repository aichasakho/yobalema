@extends('layouts.client.base')

@section('title', 'Locations')

@section('content')
    <div class="bg-secondary" style="height: 100px;"></div>
    <div class="d-flex justify-content-between">
        <h2 class="align-self-start">Liste des locations</h2>
        <a href="{{ route('admin.location.create') }}" class="btn btn-primary" >Ajouter</a>
    </div>
    <div class="d-flex justify-content-between">
        @foreach($locations as $location)
            <a href="{{ route('admin.location.show', ['location' => $location]) }}" class="btn btn-danger">afficher</a>
        @endforeach
    </div>
@endsection

