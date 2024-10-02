<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProjectoRequest extends FormRequest
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
            'acronimo' => [
                'required',
                'string',
                'min:2'
            ],
            'financiador' => [
                'nullable',
                'string',
                'min:2'
            ],
            'valor_participante' => [
                'required',
                'numeric',
                'min:2'
            ],
            'valor_nao_programado'=> [
                'required',
                'numeric',
                'min:2'
                ],
            'valor_orcamental' => [
                'required',
                'numeric',
                'min:2'
            ],

        ];
    }
}
