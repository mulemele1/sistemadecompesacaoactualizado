<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDesembolsodafRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Obtenha as regras de validação que se aplicam à requisição.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'daf_id' => [
                'required', // Permite que este campo seja nulo
                'integer',
                'exists:gestaos,id', // Verifica se existe na tabela gestaos
            ],
            'projecto_id' => [
                'required', // Permite que este campo seja nulo
                'integer',
                'exists:projectos,id', // Verifica se existe na tabela projectos
            ],
            'administracao_id' => [
                'required', // Permite que este campo seja nulo
                'integer',
                'exists:administracaos,id', // Verifica se existe na tabela administracaos
            ],
            'valor' => [
                'required', // Permite que este campo seja nulo
                'numeric',
            ],
            'data' => [
                'required', // Permite que este campo seja nulo
                'date',
            ],
            'status' => [
                'required', // Permite que este campo seja nulo
                'string',
            ],
        ];
    }
}