<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;

// Importez la facade PDF

class FactureController extends Controller
{
    public function show(Location $location)
    {
        // Générez la facture au format PDF en instanciant un objet PDF
        $pdf = PDF::loadView('clients.locations.facture', compact('location'));

        // Retournez la vue de la facture avec le PDF
        return $pdf->stream('facture.pdf');
    }
}
