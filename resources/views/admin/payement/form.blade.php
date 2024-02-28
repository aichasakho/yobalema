<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Formulaire des payements') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card col-md-8">
            <div class="card-body">


                <form method="post" class="needs-validation vstack gap-2"
                      action="{{ route($payement->exists ? 'admin.payement.update' : 'admin.payement.store', $payement) }}"
                      novalidate
                >
                    @csrf
                    @method($payement->exists ? "PUT" : "POST")

                    @include('shared.input', ['label' => "N° Location", 'name' => "location_id", 'value' => $payement->location_id])
                    @include('shared.input', ['label' => "Mode de paiement", 'name' => "mode", 'value' =>$payement->mode])
                    @include('shared.input', ['label' => "Montant", 'name' => "montant", 'value' => $payement->montant])
                    @include('shared.input', ['label' => "Date de paiement", 'name' => "date_paiement", 'value' => $payement->date_paiement])
                    <button type="submit" class="btn btn-primary">
                        @if($payement->exists)
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
