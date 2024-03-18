@extends('layouts.admin.base')

@section('title', 'afficher le Contrat')

@section('content')
    <h1>Details du contrat</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.contrat.index') }}" class="btn btn-danger">Retour</a>
    </div>
@endsection
