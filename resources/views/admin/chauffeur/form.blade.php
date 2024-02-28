<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulaire des chauffeurs') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card col-md-8">
            <div class="card-body">
                <form method="post" class="needs-validation vstack gap-2"
                      action="{{ route($chauffeur->exists ? 'admin.chauffeur.update' : 'admin.chauffeur.store', $chauffeur) }}"
                      novalidate >
                    @csrf
                    @method($chauffeur->exists ? "PUT" : "POST")

                    @include('shared.input', ['label' => "ID Voiture", 'name' => "voiture_id", 'value' => $chauffeur->voiture_id])
                    @include('shared.input', ['label' => "Expérience", 'name' => "experience", 'value' =>$chauffeur->experience])
                    @include('shared.input', ['label' => "Numéro de permis", 'name' => "numero_permis", 'value' => $chauffeur->numero_permis])
                    @include('shared.input', ['label' => "Date d'émission", 'name' => "date_emission", 'value' => $chauffeur->date_emission])
                    @include('shared.input', ['label' => "Date d'expiration", 'name' => "date_expiration", 'value' => $chauffeur->date_expiration])
                    @include('shared.input', ['label' => "Type de voiture", 'name' => "type_de_voiture", 'value' => $chauffeur->type_de_voiture])
                    @include('shared.input', ['label' => "Validité du permis", 'name' => "is_permis_valide", 'value' => $chauffeur->is_permis_valide])

                    <button type="submit" class="btn btn-primary">
                        @if($chauffeur->exists)
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
