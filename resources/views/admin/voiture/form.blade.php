<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulaire des voitures') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card col-md-8">
            <div class="card-body">


                <form method="post" class="needs-validation vstack gap-2"
                      action="{{ route($voiture->exists ? 'admin.role.update' : 'admin.role.store', $voiture) }}"
                      novalidate
                >
                    @csrf
                    @method($voiture->exists ? "PUT" : "POST")

                    @include('shared.input', ['label' => "Matricule", 'name' => "matricule", 'value' => $voiture->matricule])
                    @include('shared.input', ['label' => "Type de Voiture", 'name' => "type_de_voiture", 'value' => $voiture->type_de_voiture])
                    @include('shared.input', ['label' => "Date d'achat", 'name' => "date_achat", 'value' => $voiture->date_achat])
                    @include('shared.input', ['label' => "Km par défaut", 'name' => "km_par_defaut", 'value' => $voiture->km_par_defaut])
                    @include('shared.input', ['label' => "Statut", 'name' => "statut", 'value' => $voiture->statut])
                    <button type="submit" class="btn btn-primary">
                        @if($voiture->exists)
                            Modifier
                        @else
                            Creer
                        @endif
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
