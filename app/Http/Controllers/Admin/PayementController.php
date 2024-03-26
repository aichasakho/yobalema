<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\Payement;
use App\Models\Voiture;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PayementFormRequest;

class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payement = Payement::with('location')->get();
        return view('admin.payement.index', compact('payement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payement.form', ['payement' => new Payement()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PayementFormRequest $request): RedirectResponse
    {
        $payer = $request->validated();

        $location = Location::find($payer['location_id']);

        $payer['montant'] = $location->prix_du_trajet;
        $payer['date_paiement'] = now();

        // distance = montant / 200
        $distance = $payer['montant'] / 200;
        // vitesse moyenne 60km/heure calcule du heure d'arrivee

        $depart = Carbon::parse($location->debut_trajet);

        $arrivee = $depart->addHours($distance / 60);

        $location->update(['fin_trajet' => $arrivee]);


        Payement::create($payer);

        $voiture = Voiture::find($location->voiture_id);
        $voiture->update(['km_actuel' => $voiture->km_actuel + $distance, 'statut' => 'Marche']);


        return to_route('location.client')
            ->with('success', 'Payement effectué avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payement $payement)
    {
        return view('admin.payement.show', compact('payement'));
    }


    public function downloadFacture($id)
    {
        // Récupérez les données nécessaires à la facture en fonction de l'identifiant $id

        $location = Location::findOrFail($id);

        // Générez la facture au format PDF en utilisant les données récupérées
        $pdf = PDF::loadView('facture', compact('location'));

        // Téléchargez le fichier PDF
        return $pdf->download('facture.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payement $payement)
    {
        return view(
            'admin.payement.form',
            compact('payement')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PayementFormRequest $request, Payement $chauffeur)
    {
        $chauffeur->update($request->validated());

        return to_route('admin.payement.index')
            ->with('success', 'Payement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payement $payement)
    {
        $payement->delete();

        return redirect()
            ->back()
            ->with('success', 'Véhicule supprimer');
    }
}
