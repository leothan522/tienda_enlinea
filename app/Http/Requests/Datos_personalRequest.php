<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Datos_personalRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'cedula'            => 'required|min:9|unique:datos_personales',
            'nombre_completo'   => 'required|min:10',
            'telefono'   => 'required',
            'direccion'   => 'required|min:5'
        ];
    }
}
