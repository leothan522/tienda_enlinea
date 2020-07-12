<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentasRequest extends FormRequest
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
            'referencia'    =>  'nullable|unique:ventas,referencia,'.$this->route('venta'),
            'factura'       =>  'nullable|unique:ventas,factura,'.$this->route('venta'),
        ];
    }
}
