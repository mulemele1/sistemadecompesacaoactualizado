<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePropostaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'projecto_id' => [
                'required',
                'integer',
            ],
            'valor_requisicao' => [
                'required',
                'numeric',
            ],
            'descricao' => [
                'string',
                'required',
            ],
            'data_prop' => [
                'required',
                'date',
            ],
            'numero_prop' => [
                'nullable',
                'numeric', // Se você espera um número, considere 'numeric'
            ],
            'status' => [
                'nullable',
                'string'
            ],
        ];
    }
}