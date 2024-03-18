<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherMapService;
use Geotools\Coordinate\Coordinate;
use Geotools\Geotools;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class CityController extends Controller
{

    protected OpenWeatherMapService $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }


    /**
     * @throws GuzzleException
     */
    public function calculateDistanceBetweenCities($city1, $city2): float|int
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

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function testWeather()
    {
        try {
            $city1 = 'Dakar'; // Remplacez par une ville de votre choix
            $city2 = 'saly, senegal';
            dump($this->openWeatherMapService->getCityCoordinates($city1));
            dump($this->openWeatherMapService->getCityCoordinates($city2));
             $distance = $this->calculateDistanceBetweenCities($city1, $city2);
             dd($distance);
            return response()->json(['distance' => $distance]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
