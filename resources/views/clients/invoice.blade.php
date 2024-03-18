<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Facture</h1>
<!-- Display invoice details -->
<p>{{ $payement->mode }}</p>
<p>{{ $payement->location_id }}</p>
<p>{{ $payement->montant }}</p>
<p>{{ $payement->payment_date }}</p>
<br>
<a href="{{ route('clients.download-invoice', ['id' => $payement->id]) }}">Télécharger la facture</a>

</body>
</html>
