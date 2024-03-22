<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use UnexpectedValueException;

class GeocodioService
{

    protected $apiKey;
    protected $httpClient;

    public function __construct($apiKey)
    {
        $this->apiKey = "b153c54ffbcfb6f6f4cc5bb6cebefcb542b5be5";
        $this->httpClient = new Client();
    }


    public function geocode($addresses): array
    {
        $response = $this->httpClient->get("https://api.geocod.io/v1/", [
            'query' => [
                'q' => $addresses,
                'api_key' => $this->apiKey,
            ],
        ]);
        $result = json_decode($response->getBody(), true);


        if ($response->getStatusCode() === 200 && isset($result['location']['lat']) && isset($result['location']['lng'])) {
            return [
                'lat' => $result['location']['lat'],
                'lng' => $result['location']['lng'],
            ];



        } else {

        throw new UnexpectedValueException('Impossible de récupérer les coordonnées de la ville.');
        }
        }

}
