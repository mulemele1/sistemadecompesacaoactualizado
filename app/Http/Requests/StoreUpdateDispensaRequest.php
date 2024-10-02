<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDispensaRequest extends FormRequest
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
            'recepcao_id' => [
                'required',
                'integer',
            ],
            'projecto_id' => [
                'required',
                'integer',
            ],
            'participante_id' => [
                'required',
                'integer',
            ],
            'visita' => [
                'required',
                'string',
                'min:2',
            ],
            'valor_variavel' => [
                'nullable',
                'numeric'
            ],
                'valor' => [
                'nullable',
                'numeric'
            ],
            'motivo' => [
                'nullable',
                'string',
            ],
            
            'valor_esp' => [
                'nullable',
                'numeric'
            ],
            'motivo_esp' => [
                'nullable',
                'string',
            ],
        ];
    }
}
