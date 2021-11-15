<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'nome'       => 'required',
            'sobrenome'  => 'required',
            'cep'        => 'required|digits:8',
            'logradouro' => 'required',
            'bairro'     => 'required',
            'cidade'     => 'required',
            'uf'         => 'required'
        ];
    }


    public function messages()
    {
        return [
            'nome.required'       => '*Digite seu nome',
            'sobrenome.required'  => '*Digite seu sobrenome',
            'cep.required'        => '*Digite um CEP válido',
            'cep.digits'          => '*Digite um CEP válido',
            'logradouro.required' => '*Digite seu logradouro',
            'bairro.required'     => '*Digite seu bairro',
            'cidade.required'     => '*Digite sua cidade',
            'uf.required'         => '*Digite seu UF',
        ];
    }
}
