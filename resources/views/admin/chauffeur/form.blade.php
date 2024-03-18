@extends('layouts.admin.base')
@section('title', $chauffeur->exists ? 'Modifier le chauffeur' : 'Ajouter un chauffeur')
@section('content')
    <div class="container mt-5">
        <h1>@yield('title')</h1>
        <div class="card col-md-8 m-auto">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3 ">Ajouter un utilisateur</a>
                </div>
                <form method="post" class="gap-2 needs-validation vstack"
                      action="{{ route($chauffeur->exists ? 'admin.chauffeur.update' : 'admin.chauffeur.store', $chauffeur) }}"
                      novalidate
                      enctype="multipart/form-data"
                >
                    @csrf
                    @method($chauffeur->exists ? "PUT" : "POST")

                    <!-- choisir l'utilisateur -->
                    @if($utilisateurs)
                        <label for="user" class="form-label">Utilisateur <span class="text-danger fw-bold">*</span></label>
                        <select id="user" class="form-control" name="user_id" required>
                            <option value="">Selectionner le chauffeur</option>
                            @foreach($utilisateurs as $utilisateur)
                                @if(strtolower($utilisateur->role_user?->name) == 'chauffeur')
                                    <option
                                        value="{{ $utilisateur->id }}">{{ $utilisateur->prenom }} {{ $utilisateur->nom }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('user_id') {{ $message }} @enderror
                    @else
                        <p>Aucun utilisateur</p>
                    @endif
                    <!-- fin de choix utilisateur -->

                    @include('shared.input', ['label' => "Numero du permis", 'name' => "num_permis", 'value' => $chauffeur->num_permis])

                    @include('shared.select', ['label' => "Categorie", 'name' => "categorie", 'value' => $chauffeur->categorie, 'options' => $categories])

                    @include('shared.input', ['type' => 'date', 'name' => "date_delivrance", 'label' => "Date de delivrance", 'value' => $chauffeur->date_delivrance])

                    @include('shared.input', ['type' => 'date', 'name' => "date_expiration", 'label' => "Date de expiration", 'value' => $chauffeur->date_expiration])

                    @include('shared.input', ['type' => 'number', 'name' => "annee_experience", 'label' => 'Annees d\'experience', 'value' => $chauffeur->annee_experience])

                    @include('shared.input', ['type' => 'file', 'name' => 'image', 'label' => 'Photo du chauffeur'])
                    <button type="submit" class="btn btn-primary">
                        @if($chauffeur->exists)
                            Continuer la Modification
                        @else
                            Continuer
                        @endif
                    </button>

                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
          var today = new Date().toISOString().split('T')[0];
          document.getElementById("date_delivrance").setAttribute("max", today);
          document.getElementById("date_expiration").setAttribute("min", today);
        };
      </script>
@endsection
