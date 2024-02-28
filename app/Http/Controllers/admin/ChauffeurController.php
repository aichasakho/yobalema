<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChauffeurFormRequest;
use App\Models\Contrat;
use Illuminate\Http\Request;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chauffeur = Contrat::with('vehicule')
            ->paginate(20);
        return view('admin.chauffeur.index',
            compact('chauffeur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chauffeur.form',
            ['chauffeur' => new Contrat()]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChauffeurFormRequest $request)
    {
        Contrat::create($request->validated());

        return to_route('admin.chauffeur.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $chauffeur)
    {
        return view('admin.chauffeur.show', ['chauffeur' => new Contrat()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $chauffeur)
    {
        return view('admin.chauffeur.form',
            compact('chauffeur'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChauffeurFormRequest $request, Contrat $chauffeur)
    {
        $chauffeur->update($request->validated());

        return to_route('admin.chauffeur.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $chauffeur)
    {
        $chauffeur->delete();

        return redirect()
            -> back()
            -> with('success', 'Véhicule supprimer');
    }
}
