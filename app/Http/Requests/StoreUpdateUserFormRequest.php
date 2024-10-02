<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUserFormRequest extends FormRequest
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
        $id = $this->id ?? "";//Código para sobrescrever uma coluna unica
        $rules = [
            'name' => [
                'required',
                'string',
                'min:2'
            ],
            'email' => [
                'required',
                'email',
                "unique:users,email,{$id},id",
            ],
            'password' => [
                'required',
                'min:6',
                'max:15',
            ],
            'type' => [
                'required',
                'min:3',
                'max:15',
            ],
            'recepcao_id' => [
                'nullable',
            ]
        ];

        if ($this->method('PUT')) {
            $rules['password'] = [
                'required',
                'min:6',
                'max:15'
            ];
        }

        return $rules;
    }
}
