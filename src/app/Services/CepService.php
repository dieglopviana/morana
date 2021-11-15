<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CepService {

    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }


    public function request($verbo, $uri, $options = [])
    {
        return $this->httpClient->request($verbo, $uri, $options);
    }


}