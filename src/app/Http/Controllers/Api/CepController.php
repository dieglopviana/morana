<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CepService;

class CepController extends Controller
{
    
    public function index($cep, CepService $client){
        try {
            $result = $client->request('GET', "https://viacep.com.br/ws/{$cep}/json/");
            $jsonCep = $result->getBody()->getContents();

            $res = json_decode($jsonCep);

            if (isset($res->erro)){
                return response()->json(['status_error' => true, 'message' => $res->erro]);
            }
            
            return response()->json([
                'status_error' => false, 
                'cep' => json_decode($jsonCep)
            ]);
        } catch (\Exception $e) {
            return response()->json(['status_error' => true,'message' => '*CEP Inválido'], $e->getCode());
        }
    }

}
