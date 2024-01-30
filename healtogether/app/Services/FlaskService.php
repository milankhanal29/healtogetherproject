<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class FlaskService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:5000';
    }
    public function clusterData(array $data)
    {
        try {
            $client = new Client();
            $response = $client->post($this->baseUrl . '/surveys', [
                'json' => $data,
            ]);
    
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
}
