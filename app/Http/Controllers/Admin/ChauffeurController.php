<?php

namespace App\Http\Controllers\Admin;

use App\Models\Note;
use App\Models\User;
use App\Models\Location;
use App\Models\Vehicule;
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

        $data = $request->validated();
        $data['is_permis_valide'] = true;
        /* @var UploadedFile|null $image */
        $image = $request->validated('image');

        if ($image == null || $image->getError()) {
            return $data;
        } else {

            if ($chauffeur->image) {
                Storage::disk('public')->delete($chauffeur->image);
            }

            $data['image'] = $image->store('chauffeur', 'public');
        }

        return $data;
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
            if ($user->chauffeurs?->num_permis != null) {
                $chauffeurs[] = $user;
            }
        }
        return view('admin.chauffeur.index', ['users' => $chauffeurs,]);
    }


    public function addVehicule(Chauffeur $chauffeur)
    {
        $error = '';
        if ($chauffeur->is_permis_valide) {

            if ($chauffeur->categorie == 'B') {
                $vehicule = Vehicule::where('categorie', '=', 'VOITURE')
                    ->whereNull('chauffeur_id')
                    ->where('statut', '=', 'DISPONIBLE')
                    ->first();

                if ($vehicule == null) {
                    $error = 'Aucune Voiture disponible pour l\'instant';
                } else {
                    $chauffeur->update(['vehicule_id' => $vehicule->id]);
                    $vehicule->update(['chauffeur_id' => $chauffeur->id]);
                }
            } elseif ($chauffeur->categorie == 'C') {
                $vehicule = Vehicule::where('categorie', '=', 'CAMION')
                    ->where('statut', '=', 'DISPONIBLE')
                    ->whereNull('chauffeur_id')
                    ->first();

                if ($vehicule == null) {
                    $error = 'Aucun Camion disponible pour l\'instant';
                } else {
                    $chauffeur->update(['vehicule_id' => $vehicule->id]);
                    $vehicule->update(['chauffeur_id' => $chauffeur->id]);
                }
            } else {
                $vehicule = Vehicule::where('categorie', '=', 'BUS')
                    ->where('statut', '=', 'DISPONIBLE')
                    ->whereNull('chauffeur_id')
                    ->first();

                if ($vehicule == null) {
                    $error = 'Aucun BUS disponible pour l\'instant';
                } else {
                    $chauffeur->update(['vehicule_id' => $vehicule->id]);
                    $vehicule->update(['chauffeur_id' => $chauffeur->id]);
                }
            }
        } else {
            $error = 'Desole Votre permis n\'est plus valide';
        }

        if ($error == '') {
            return to_route('admin.chauffeur.index')
                ->with('success', 'Unvehicule vous ete assigne');
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
            $data = $this->setImage(new Chauffeur(), $request);
            Chauffeur::create($data);
            $chauffeur = Chauffeur::latest()->first();
            if ($chauffeur) {
                $users = User::with('chauffeurs')
                    ->where('role_user_id', '=', 3)->get();
                foreach ($users as $user) {
                    if ($user->chauffeurs?->num_permis != null) {
                        $chauffeurs[] = $user;
                    }
                }
            }
        } catch (\Exception $ex) {
            dd($ex);
        }
        return to_route('admin.contrat.create', ['chauffeurs' => $chauffeurs ? $chauffeurs : new User()])
            ->with('success', 'Chauffeur créé avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show(Chauffeur $chauffeur)
    {
        return view('admin.chauffeur.show', ['chauffeur' => new Chauffeur()]);
    }

    public function noter(Request $request)
    {
        $validation = $request->validate([
            'note' => 'required|integer',
            'location_id' => 'required|integer',
        ]);

        $location = Location::find($validation['location_id']);
        $validation['chauffeur_id'] = $location->chauffeur_id;
        $validation['user_id'] = auth()->user()->id;

        Note::create($validation);

        return to_route('location.client')
            ->with('success', 'Chauffeur note');
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
            ->with('success', 'Role modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()
            ->back()
            ->with('success', 'Véhicule supprimé');
    }
}
