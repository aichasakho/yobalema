<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chauffeurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="card col-md-8 m-auto">
            <div class="card-header">
                <a href="{{ route("admin.chauffeur.create") }}" class="btn btn-primary"> Ajouter</a>
            </div>
        <table class="table table-striped">
            <thead class="table-header-group">
            <tr>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($chauffeurs as $chauffeur)
                    <tr>
                        <td>{{ $chauffeur->matricule }}</td>
                        <td>
                            <a href="{{ route("admin.chauffeur.edit", $chauffeur) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route("admin.chauffeur.destroy", $chauffeur) }}" method="post"
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
</x-app-layout>
