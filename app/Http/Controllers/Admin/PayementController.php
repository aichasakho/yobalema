<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Location;
use App\Models\Payement;
use App\Models\Vehicule;
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

        $payer['montant'] = $location->prix_estime;
        $payer['date_paiement'] = now();

        // distance = montant / 500
        $distance = $payer['montant'] / 500;
        // vitesse moyenne 60mk/heure calcule du heure d'arrivee

        $depart = Carbon::parse($location->heure_depart);

        $arrivee = $depart->addHours($distance / 60);

        $location->update(['heure_arrivee' => $arrivee]);

        Payement::create($payer);

        $vehicule = Vehicule::find($location->vehicule_id);
        $vehicule->update(['km_actuel' => $vehicule->km_actuel + $distance]);

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
