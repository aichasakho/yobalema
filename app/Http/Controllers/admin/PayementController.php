<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayementFormRequest;
use App\Models\Payement;

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
    public function store(PayementFormRequest $request)
    {
        Payement::create($request->validated());

        return to_route('admin.payement.index')
            -> with('success', 'Payement modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payement $payement)
    {
        return view('admin.payement.show', compact('payement') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payement $payement)
    {
        return view('admin.payement.form',
            compact('payement'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PayementFormRequest $request, Payement $chauffeur)
    {
        $chauffeur->update($request->validated());

        return to_route('admin.payement.index')
            -> with('success', 'Payement modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payement $payement)
    {
        $payement->delete();

        return redirect()
            -> back()
            -> with('success', 'Véhicule supprimer');
    }
}
