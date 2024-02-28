<?php

namespace App\Http\Controllers;

use App\Http\Requests\voitureFormRequest;
use App\Models\voiture;

class voitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voiture = voiture::with('chauffeur')
            ->paginate(20);
        return view('admin.voiture.index', compact('voiture'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voiture.form', ['voiture' => new voiture()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(voitureFormRequest $request)
    {
        voiture::create($request->validated());

        return to_route('admin.voiture.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(voiture $voiture)
    {
        return view('admin.voiture.show', compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(voiture $voiture)
    {
        return view('admin.voiture.form', compact('voiture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(voitureFormRequest $request, voiture $voiture)
    {
        $voiture->update($request->validated());

        return to_route('admin.voiture.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $voiture)
    {
        $voiture->delete();

        return redirect()
            -> back()
            -> with('success', 'Voiture supprimer');
    }
}
