<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateGestaoRequest extends FormRequest
{
    /**
     * Determine se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Alterado para true para permitir a autorização
    }

    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required', // Adicionado 'required' para garantir que o campo não esteja vazio
                'string',
                'min:2',
            ],
        ];
    }
}