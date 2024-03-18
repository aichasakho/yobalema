@extends('layouts.clients.base')

@section('title', "Payement")

@section('content')
    <h1>Page de paiement</h1>

    <form action="{{ route('clients.payement', ['payement' => $payement]) }}" method="POST">
        @csrf

        <!-- Affichez les informations du client, par exemple : -->
        <p>Nom du client : {{ $payement->location->client->name }}</p>
        <p>Montant à payer : {{ $payement->montant }}</p>
        <!-- Ajoutez d'autres champs d'informations si nécessaire -->

        <!-- Champ pour le mode de paiement -->
        <div>
            <label for="mode">Mode de paiement:</label>
            <select name="mode" id="mode">
                <option value="carte">Carte de crédit</option>
                <option value="paypal">PayPal</option>
                <!-- Ajoutez d'autres options de paiement si nécessaire -->
            </select>
        </div>

        <!-- Bouton de soumission -->
        <button type="submit">Valider le paiement</button>
    </form>
@endsection
