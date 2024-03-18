@extends('layouts.admin.base')

@section('title', 'Formulaire Des Roles')

@section('content')

    <div class="container mt-5">
        <div class="card col-md-8">
            <div class="card-body">
                <form method="post" class="needs-validation vstack gap-2"
                      action="{{ route($role->exists ? 'admin.role.update' : 'admin.role.store', $role) }}"
                      novalidate
                >
                    @csrf
                    @method($role->exists ? "PUT" : "POST")

                    @include('shared.input', ['label' => "Nom", 'name' => "name", 'value' => $role->name])

                    <button type="submit" class="btn btn-primary">
                        @if($role->exists)
                            Modifier
                        @else
                            Creer
                        @endif
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
