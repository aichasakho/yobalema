<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use App\Models\Voiture;
use GuzzleHttp\Exception\GuzzleException;
use App\Services\NominatimService;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    protected $nominatimService;

    public function __construct(NominatimService $nominatimService)
    {
        $this->nominatimService = $nominatimService;
    }

    public function geocodeAddresses($depart, $arrivee): float|int
    {
        ;

        // Géocodage des adresses de départ et d'arrivée
        $departResult = $this->nominatimService->geocode($depart);
        $arriveeResult = $this->nominatimService->geocode($arrivee);

        // Vérifiez si les résultats de géocodage sont valides
        if (!empty($departResult) && !empty($arriveeResult)) {
            // Vérifiez si les indices 0 existent dans les tableaux $departResult et $arriveeResult
            if (isset($departResult['lat'], $departResult['lon'], $arriveeResult[0]['lat'], $arriveeResult[0]['lon'])) {
                // Récupération des coordonnées géographiques des localités de départ et d'arrivée
                $departLatitude = $departResult['lat'];
                $departLongitude = $departResult['lon'];
                $arriveeLatitude = $arriveeResult['lat'];
                $arriveeLongitude = $arriveeResult['lon'];

                // Appel de la méthode calculateDistance() avec les 4 arguments requis
                return $this->calculateDistance($departLatitude, $departLongitude, $arriveeLatitude, $arriveeLongitude);
            } else {
                // Rendu de la vue avec les résultats de géocodage
                return 0;
                //return view('clients.index', compact('departResult', 'arriveeResult'));
            }
        } else {
            // Renvoyer une réponse JSON avec un message d'erreur
            //return response()->json(['error' => 'Erreur de géocodage']);
            return -1;
        }
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2): float|int
    {
        $earthRadius = 6371; // Rayon de la Terre en kilomètres

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    /*public function updateLocation(NominatimService $nominatimService)
    {
        // Effectuer la requête à Nominatim pour obtenir les nouvelles coordonnées géographiques
        $coordinates = $nominatimService->getCoordinates();

        // Retourner les coordonnées au format JSON
        return response()->json($coordinates);
    }*/

    public function store(LocationFormRequest $request)
    {
        // Montant 200 par km
        $montantParKm = 200;

        $location = $request->validated();

        $depart = $location['lieu_depart'];
        $arrivee = $location['lieu_d_arrive'];

        // Géocodage des adresses de départ et d'arrivée
        $distance = $this->geocodeAddresses($depart, $arrivee);


        if ($distance === -1) {
            return redirect()->back()->with('error', 'Adresse invalide');
        }

        $montant = $montantParKm * $distance;

        $location['prix_du_trajet'] = $montant;
        $location['client_id'] = auth()->user()->id;

        // Recuperation des voiture dans la categorie disponible;

        $voiture = Voiture::where('type_de_voiture', '=', $location['voiture_id'])
            ->whereNotNull('chauffeur_id')
            ->where('statut', '=', 'Marche')
            ->first();

        if ($voiture == null) {
            return redirect()
                ->back()
                ->with('error', 'Voiture non disponible dans cette categorie pour l\'instant');
        }

        if ($voiture->id == null || $voiture->chauffeur == null || $voiture->chauffeur->id == null) {
            return redirect()
                ->back()
                ->with('error', 'Voiture non disponible');
        }

        $location['voiture_id'] = $voiture->id;

        $location['chauffeur_id'] = $voiture->chauffeur->id;

        /*if ($location['voiture_id'] == null || $location['chauffeur_id'] == null) {
            return redirect()
                ->back()
                ->with('error', 'Voiture non disponible');
        }*/

        Location::create($location);
        $voiture->update(['statut' => 'location']);

        return redirect()
            ->route('location.client')
            ->with('success', 'Location créée avec succès');
    }



    public function index()
    {
        $locations = Location::all();
        return view('clients.locations.index', ['locations' => $locations]);
    }

    public function clientlocation()
    {
        $locations = Location::with('voiture', 'chauffeur')
            ->where('client_id', '=', auth()->user()->id)
            ->get();

        return view('clients.locations.index', ['locations' => $locations]);
    }






    public function show(Location $location)
    {
        return view('admin.locations.show', ['location' => $location]);
    }

    public function edit(Location $location)
    {
        return view('admin.locations.form', ['location' => $location]);
    }

    public function update(LocationFormRequest $request, Location $location)
    {
        $location->update($request->validated());
        return redirect()->route('admin.location.index')->with('success', 'Location mise à jour');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Location supprimée !');
    }
}
