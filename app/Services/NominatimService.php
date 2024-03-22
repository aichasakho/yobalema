<?php
namespace App\Services;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

class NominatimService
{
    protected $httpClient;

public function __construct(Client $httpClient)
{
    $this->httpClient = $httpClient;
}

    public function geocode($address): array
    {
        $response = $this->httpClient->get("https://nominatim.openstreetmap.org/search", [
            'query' => [
                'q' => $address,
                'format' => 'json',
                'limit' => 1, // Limite le résultat à une seule adresse
            ],
        ]);

        $results = json_decode($response->getBody(), true);

        if (!empty($results)) {
            $latitude = $results[0]['lat'];
            $longitude = $results[0]['lon'];

            return [
                'lat' => $latitude,
                'lng' => $longitude,
            ];
        } else {
            throw new UnexpectedValueException('Impossible de récupérer les coordonnées pour cette adresse.');
        }
    }
}
