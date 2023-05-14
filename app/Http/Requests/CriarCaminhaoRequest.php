<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriarCaminhaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'placa' => [
                'required',
                'string',
                'unique:App\Models\Caminhao,placa',
                'size:8',
                'regex:/[A-Z]{3}-\d[A-Z]\d{2}/'
            ],
            'motorista_id' => [
                'required',
                'integer'
            ],
            'modelo_id' => [
                'required',
                'integer'
            ],
            'cor' => [
                'required',
                'string',
                'max:50'
            ]
        ];
    }
}
