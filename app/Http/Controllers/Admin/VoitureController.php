<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoitureFormRequest;
use App\Models\Voiture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VoitureController extends Controller
{

    private array $status = [
        "Disponible" => 'Marche',
        "En panne" =>'Panne',
        'En Location' => 'location',
    ];


    private array $type_de_voiture = array(
        "Camion" => 'Camion',
        "Voiture" => 'Voiture',
        'Bus' => 'Bus',
    );

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $voitures = Voiture::with('chauffeur')
            ->paginate(15);
        return view('admin.voiture.index', compact('voitures'));
    }


    private function setImage(Voiture $voiture, VoitureFormRequest $request) {

        $donnee = $request->validated();
        /* @var UploadedFile|null $image */
        $image = $request->validated('image_voiture');

        if ( $image == null || $image->getError() ){
            return $donnee;
        }
        else
        {
            if ($voiture->image_voiture)
            {
                Storage::disk('public')->delete($voiture->image_voiture);
            }
            $donnee['image_voiture'] = $image->store('voiture', 'public');
        }

        return $donnee;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voiture.form', [
            'voiture' => new Voiture(),
            'statuts' => $this->status,
            'type_de_voiture' => $this->type_de_voiture,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoitureFormRequest $request)
    {

        try {
            $donnee = $this->setImage(new Voiture(), $request);
            $donnee['km_actuel'] = $donnee['km_par_defaut'];
            Voiture::create($donnee);
        } catch (\Exception $ex) {
        }

        return to_route('admin.voiture.index')
            -> with('success', 'Voiture modifié avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voiture $voiture)
    {
        return view('admin.voiture.show',compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voiture $voiture)
    {
        return view('admin.voiture.form', [
            'voiture' => $voiture,
            'statuts' => $this->status,
            'type_de_voiture' => $this->type_de_voiture,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoitureFormRequest $request, Voiture $voiture)
    {
        $voiture->update($this->setImage($voiture, $request));

        return to_route('admin.voiture.index')
            -> with('success', 'Voiture modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $voiture)
    {
        $voiture->delete();

        return redirect()
            -> back()
            -> with('success', 'Voiture supprimé avec succès');
    }
}
