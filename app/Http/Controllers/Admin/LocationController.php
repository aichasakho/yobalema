<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CityController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use App\Models\Vehicule;
use App\Services\OpenWeatherMapService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Carbon;

class LocationController extends Controller
{

    protected OpenWeatherMapService $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }

    /**
     * @throws GuzzleException
     * @throws GuzzleException
     */
    public function calculateDistance($city1, $city2): float|int
    {

        // Obtenez les coordonnées géographiques des deux villes
        $coordinatesCity1 = $this->openWeatherMapService->getCityCoordinates($city1);
        $coordinatesCity2 = $this->openWeatherMapService->getCityCoordinates($city2);

        // Créez les objets de coordonnées
        // Utilisez la formule de Haversine pour calculer la distance
        return $this->haversineDistance(
            $coordinatesCity1['lat'], $coordinatesCity1['lon'],
            $coordinatesCity2['lat'], $coordinatesCity2['lon']
        );
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2): float|int
    {
        $earthRadius = 6371; // Rayon moyen de la Terre en kilomètres

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function clocation()
    {
        $locations = Location::with('vehicule', 'chauffeur')
            ->where('client_id', '=', auth()->user()->id)
            ->get();

        $statut = [];
        foreach ($locations as $location) {
            if ($location->heure_arrivee !== null) {
                $arrivee = Carbon::parse($location->heure_arrivee);
                $now = Carbon::now();
                if($arrivee->gt($now)) {
                    $statut[$location->id] = 'En cours';
                } else {
                    $statut[$location->id] = 'Terminée';
                }
            } else {
                $statut[$location->id] = 'Pas Encore de payement';
            }
        }


        return view('locations.my-locations',
            ['locations' => $locations, 'statut' => $statut]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', ['locations' => $locations]);
    }


    /**
     * Store a newly created resource in storage.
     * @throws GuzzleException
     */
    public function store(LocationFormRequest $request)
    {
        // Montant 500 par km

        $location = $request->validated();

        $distance = $this->calculateDistance($location['lieu_depart'], $location['lieu_destination']);

        $montant = 500 * $distance;

        $location['prix_estime'] = $montant;
        $location['client_id'] = auth()->user()->id;

        // Recuperation des vehicule dans la categorie disponible;

        $vehicule = Vehicule::where('categorie', '=', $location['vehicule_id'])
                    ->whereNotNull('chauffeur_id')
                    ->where('statut', '=', 'DISPONIBLE')
                    ->first();

        if ($vehicule == null) {
            return redirect()
                ->back()
                ->with('error', 'Vehicule non disponible dans cette categorie pour l\'instant');
        }

        $location['vehicule_id'] = $vehicule->id;

        $location['chauffeur_id'] = $vehicule->chauffeur->id;

        if ($location['vehicule_id'] == null || $location['chauffeur_id'] == null) {
            return redirect()
                ->back()
                ->with('error', 'Vehicule non disponible');
        }

        Location::create($location);
        $vehicule->update(['statut' => 'EN LOCATION']);

        return to_route('location.client')
            ->with('success', 'location Créé avec success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        return view('admin.locations.show', ['location' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        return view('admin.locations.form', ['location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationFormRequest $request, Location $location)
    {
        $location->update($request->validated());
        return to_route('admin.location.index')
            ->with('success', 'Location mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Location supprimée !');
    }
}
