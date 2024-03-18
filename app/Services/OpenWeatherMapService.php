<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

class OpenWeatherMapService
{
    protected $apiKey;
    protected Client $httpClient;

    public function __construct()
    {
        $this->apiKey = "bdc51c0830705f7b30c1482ec75c97ad";
        $this->httpClient = new Client();
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function getCityCoordinates($city): array
    {
        // Faites une requête à l'API OpenWeatherMap pour obtenir les coordonnées de la ville
        $response = $this->httpClient->get("http://api.openweathermap.org/data/2.5/weather", [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        // Vérifiez si la requête a réussi
        if ($response->getStatusCode() == 200 && isset($data['coord']['lat']) && isset($data['coord']['lon'])) {
            // Retournez les coordonnées de la ville
            return [
                'lat' => $data['coord']['lat'],
                'lon' => $data['coord']['lon'],
            ];
        } else {
            // Gérez les erreurs ici, par exemple, en lançant une exception
            throw new UnexpectedValueException('Impossible de récupérer les coordonnées de la ville depuis OpenWeatherMap.');
        }
    }
}
