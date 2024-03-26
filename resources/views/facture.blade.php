<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        .invoice p {
            margin: 0;
            padding: 5px 0;
        }

        .invoice .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice .section {
            margin-bottom: 10px;
        }

        .invoice .section .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="invoice">
    <p class="title">Facture</p>

    <div class="section">
        <p class="label">Client:</p>
        <p>{{ $location?->client?->nom }}</p>
    </div>

    <div class="section">
        <p class="label">Départ:</p>
        <p>{{ $location->debut_trajet }}</p>
    </div>

    <div class="section">
        <p class="label">Arrivée:</p>
        <p>{{ $location->fin_trajet ?? 'Non défini' }}</p>
    </div>

    <div class="section">
        <p class="label">Montant à payer:</p>
        <p>{{ round($location->prix_du_trajet) }} Fcfa</p>
    </div>

    <div class="section">
        <p class="label">Lieu de Départ:</p>
        <p>{{ $location->lieu_depart }}</p>
    </div>

    <div class="section">
        <p class="label">Lieu d'arrivée:</p>
        <p>{{ $location->lieu_d_arrive }}</p>
    </div>

    <div class="section">
        <p class="label">Chauffeur en charge:</p>
        <p>{{ $location?->chauffeur?->user?->nom }}</p>
    </div>

    <div class="section">
        <p class="label">Voiture:</p>
        <p>{{ $location->voiture?->matricule }}</p>
    </div>
</div>
</body>
</html>
