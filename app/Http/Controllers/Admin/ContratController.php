<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContratFormRequest;
use App\Models\Contrat;
use App\Models\User;

class ContratController extends Controller
{
    private array $type_contrats = ['contrat limité' => 'CDD', 'contrat illimité' => 'CDI'];

    public function getUsers()
    {
        $users = [];
        $list_users = User::with('chauffeurs')->get();
        foreach ($list_users as $user){
            if($user->chauffeurs?->num_permis != null){
                $users[] = $user;
            }
        }
        return $users;
    }

    public function getChauffeursId()
    {
        $chauffeurs = $this->getUsers();
        $ids = [];
        foreach ($chauffeurs as $chauffeur){
            $ids[$chauffeur->nom . $chauffeur->prenom] = $chauffeur->id;
        }
        return $ids;
    }

    public function getContrats()
    {
        $users = User::with('contrats', 'chauffeurs')->get();
        $contrats = [];
        foreach ($users as $user){
            if($user->contrats?->date_embauche != null){
                $contrats[] = $user;
            }
        }
        return $contrats;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contrats = $this->getContrats();
//        dd($contrats);
        return view('admin.contrats.index', [
            'users' => $contrats,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $chauffeurs = $this->getChauffeursId();
        return view('admin.contrats.form', [
            'contrat' => new Contrat(),
            'type_contrats' => $this->type_contrats,
            'chauffeurs' => $chauffeurs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContratFormRequest $request)
    {
        Contrat::create($request->validated());
        return to_route('admin.contrat.index')
            ->with('succes', 'Contrat Créé avec succés');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrat $contrat)
    {
        return view('admin.contrats.show', [
            'contrat' => $contrat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrat $contrat)
    {
        return view('admin.contrats.form',
        [
            'contrat' => $contrat,
            'type_contrats' => $this->type_contrats,
            'chauffeurs' => $this->getChauffeursId(),
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContratFormRequest $request, Contrat $contrat)
    {
        $contrat->update($request->validated());
        $chauffeurs = $this->getChauffeursId();
        return to_route('admin.contrat.index', [
            'chauffeurs' => $chauffeurs,
        ])
            ->with('success', "Contrat mis a jour");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrat $contrat)
    {
        $contrat->delete();
        return redirect()->back()->with('success', "Contrat supprimé");
    }
}
