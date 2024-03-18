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


    private array $categories = array(
        "Camion" => 'Camion',
        "Voiture" => 'Voiture',
        'Bus' => 'Bus',
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Voitures = Voiture::with('chauffeur')
            ->paginate(15);
        return view('admin.Voiture.index', compact('Voitures'));
    }


    private function setImage(Voiture $Voiture, VoitureFormRequest $request) {

        $data = $request->validated();

        /* @var UploadedFile|null $image */
        $image = $request->validated('image_Voiture');

        if ( $image == null || $image->getError() ){
            return $data;
        }
        else
        {

            if ($Voiture->image_Voiture)
            {
                Storage::disk('public')->delete($Voiture->image_Voiture);
            }

            $data['image_Voiture'] = $image->store('Voiture', 'public');

        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Voiture.form', [
            'Voiture' => new Voiture(),
            'statuts' => $this->status,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoitureFormRequest $request)
    {

        try {
            $data = $this->setImage(new Voiture(), $request);
            $data['km_actuel'] = $data['km_defaut'];
            Voiture::create($data);
        } catch (\Exception $ex) {
            dd($ex);
        }

        return to_route('admin.Voiture.index')
            -> with('success', 'Voiture ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voiture $Voiture)
    {
        return view('admin.Voiture.show',compact('Voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voiture $Voiture)
    {
        return view('admin.Voiture.form', [
            'Voiture' => $Voiture,
            'statuts' => $this->status,
            'categories' => $this->categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoitureFormRequest $request, Voiture $Voiture)
    {
        $Voiture->update($this->setImage($Voiture, $request));

        return to_route('admin.Voiture.index')
            -> with('success', 'Voiture modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $Voiture)
    {
        $Voiture->delete();

        return redirect()
            -> back()
            -> with('success', 'Voiture supprimé avec succès');
    }
}
