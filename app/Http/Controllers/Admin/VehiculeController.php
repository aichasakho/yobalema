<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculeFormRequest;
use App\Models\Vehicule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VehiculeController extends Controller
{
    /**
     * Liste des états possibles des véhicules dans notre application.
     * Sert principalement au remplissage du champ de selection dans le formulaire de
     * création d'un véhicule.
     * @var array|string[]
     */
    private array $status = [
        "Disponible" => 'DISPONIBLE',
        "En panne" =>'PANNE',
        'En Location' => 'EN LOCATION',
    ];

    /**
     * Répertorie la liste des categories de véhicules disponible dans notre application.
     * Elle permet principalement de remplir les options des champs de sélection de la
     * catégorie dans le formulaire de creation des véhicules.
     * @var array|string[]
     */
    private array $categories = array(
        "Camion" => 'CAMION',
        "Voiture" => 'VOITURE',
        "Camion Citerne" => 'CITERNE',
        'Bus' => 'BUS',
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules = Vehicule::with('chauffeur')
            ->paginate(15);
        return view('admin.vehicule.index', compact('vehicules'));
    }

    /**
     * Cette methode permet la gestion efficace de l'ajout et de la misa jour
     * de l'image du véhicule que l'on souhaite ajouter ou modifier.
     * Elle reçoit la request et une instance de véhicule puis sauvegarde le fichier
     * récupéré dans le dossier vehicule
     * @param Vehicule $vehicule
     * @param VehiculeFormRequest $request
     * @return mixed
     */
    private function setImage(Vehicule $vehicule, VehiculeFormRequest $request) {

        $data = $request->validated();
        /* @var UploadedFile|null $image */
        $image = $request->validated('image_vehicule');

        if ( $image == null || $image->getError() ){
            return $data;
        }
        else
        {
            if ($vehicule->image_vehicule)
            {
                Storage::disk('public')->delete($vehicule->image_vehicule);
            }
            $data['image_vehicule'] = $image->store('vehicule', 'public');
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicule.form', [
            'vehicule' => new Vehicule(),
            'statuts' => $this->status,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehiculeFormRequest $request)
    {

        try {
            $data = $this->setImage(new Vehicule(), $request);
            $data['km_actuel'] = $data['km_defaut'];
            Vehicule::create($data);
        } catch (\Exception $ex) {
            dd($ex);
        }

        return to_route('admin.vehicule.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicule $vehicule)
    {
        return view('admin.vehicule.show',compact('vehicule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicule $vehicule)
    {
        return view('admin.vehicule.form', [
            'vehicule' => $vehicule,
            'statuts' => $this->status,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehiculeFormRequest $request, Vehicule $vehicule)
    {
        $vehicule->update($this->setImage($vehicule, $request));

        return to_route('admin.vehicule.index')
            -> with('success', 'Role modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();

        return redirect()
            -> back()
            -> with('success', 'Véhicule supprimer');
    }
}
