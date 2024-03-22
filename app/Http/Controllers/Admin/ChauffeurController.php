<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commentaire;
use App\Models\Note;
use App\Models\User;
use App\Models\Location;
use App\Models\Voiture;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChauffeurFormRequest;


class ChauffeurController extends Controller
{

    private array $categories_permis =   [
        'categorie A1' => 'A1',
        'categorie A' => 'A',
        'categorie B' => 'B',
        'categorie C' => 'C',

    ];

    private function setImage(Chauffeur $chauffeur, ChauffeurFormRequest $request)
    {

        $donnee = $request->validated();
        $donnee['is_permis_valide'] = true;
        /* @var UploadedFile|null $image */
        $image = $request->validated('image');

        if ($image == null || $image->getError()) {
            return $donnee;
        } else {

            if ($chauffeur->image) {
                Storage::disk('public')->delete($chauffeur->image);
            }

            $donnee['image'] = $image->store('chauffeur', 'public');
        }

        return $donnee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chauffeurs = [];
        $users = User::with('chauffeurs')
            ->where('role_user_id', '=', 3)->get();
        foreach ($users as $user) {
            if ($user->chauffeurs?->numero_permis != null) {
                $chauffeurs[] = $user;
            }
        }
        return view('admin.chauffeur.index', ['users' => $chauffeurs,]);
    }


    public function addVoiture(Chauffeur $chauffeur)
    {
        $error = '';
        if ($chauffeur->is_permis_valide) {

            if ($chauffeur->categorie == 'B') {
                $voiture = Voiture::where('type_de_voiture', '=', 'Voiture')
                    ->whereNull('chauffeur_id')
                    ->where('statut', '=', 'Marche')
                    ->first();

                if ($voiture == null) {
                    $error = 'Aucune voiture n\'est  disponible pour le moment';
                } else {
                    $chauffeur->update(['voiture_id' => $voiture->id]);
                    $voiture->update(['chauffeur_id' => $chauffeur->id]);
                }
            } elseif ($chauffeur->categorie == 'C') {
                $voiture = Voiture::where('type_de_voiture', '=', 'Camion')
                    ->where('statut', '=', 'Marche')
                    ->whereNull('chauffeur_id')
                    ->first();

                if ($voiture == null) {
                    $error = 'Aucun Camion n\'est  disponible pour le moment';
                } else {
                    $chauffeur->update(['voiture_id' => $voiture->id]);
                    $voiture->update(['chauffeur_id' => $chauffeur->id]);
                }
            } else {
                $voiture = Voiture::where('type_de_voiture', '=', 'Bus')
                    ->where('statut', '=', 'Marche')
                    ->whereNull('chauffeur_id')
                    ->first();

                if ($voiture == null) {
                    $error = 'Aucun Bus n\'est  disponible pour le moment';
                } else {
                    $chauffeur->update(['voiture_id' => $voiture->id]);
                    $voiture->update(['chauffeur_id' => $chauffeur->id]);
                }
            }
        } else {
            $error = 'Oups! permis invalide';
        }

        if ($error == '') {
            return to_route('admin.chauffeur.index')
                ->with('success', 'Parfait!!!');
        } else {
            return redirect()->back()
                ->with('error', $error);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.chauffeur.form', [
            'chauffeur' => new User(),
            'utilisateurs' => User::with('role_user')->get(),
            'categories' => $this->categories_permis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChauffeurFormRequest $request)
    {
        $chauffeurs = [];
        try {
            $donnee = $this->setImage(new Chauffeur(), $request);
            Chauffeur::create($donnee);
            $chauffeur = Chauffeur::latest()->first();
            if ($chauffeur) {
                $users = User::with('chauffeurs')
                    ->where('role_user_id', '=', 3)->get();
                foreach ($users as $user) {
                    if ($user->chauffeurs?->numero_permis != null) {
                        $chauffeurs[] = $user;
                    }
                }
            }
        } catch (\Exception $ex) {
            dd($ex);
        }
        return to_route('admin.contrat.create', ['chauffeurs' => $chauffeurs ? $chauffeurs : new User()])
            ->with('success', 'Chauffeur ajouté avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show(Chauffeur $chauffeur)
    {
        return view('admin.chauffeur.show', ['chauffeur' => new Chauffeur()]);
    }

    public function commenter(Request $request)
    {
        $validation = $request->validate([
            'commentaire' => 'required|string',
            'location_id' => 'required|integer',
        ]);

        $location = Location::find($validation['location_id']);
        $validation['chauffeur_id'] = $location->chauffeur_id;
        $validation['user_id'] = auth()->user()->id;

        Commentaire::create($validation);

        return to_route('location.client')
            ->with('success', 'Commentaire bien enregistré!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chauffeur $chauffeur)
    {
        return view('admin.chauffeur.form', [
            'chauffeur' => $chauffeur,
            'utilisateurs' => User::with('role_user')->get(),
            'categories' => $this->categories_permis,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChauffeurFormRequest $request, Chauffeur $chauffeur)
    {
        $chauffeur->update($request->validated());
        return to_route('admin.chauffeur.index')
            ->with('success', 'Chauffeur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()
            ->back()
            ->with('success', 'Chauffeur supprimé avec succès');
    }
}
