<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDistribuicaoRequest extends FormRequest
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
            'administracao_id' => [
                'required',
                'integer',
            ],
            'projecto_id' => [
                'required',
                'integer',
            ],
            'recepcao_id' => [
                'required',
                'integer',
            ],
            'valor' => [
                'required',
                'numeric'
            ],
        ];
    }
}
