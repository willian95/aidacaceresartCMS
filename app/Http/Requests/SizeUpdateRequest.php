<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeUpdateRequest extends FormRequest
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
            "width" => "required|numeric",
            "height" => "required|numeric",
        ];
    }


    public function messages()
    {
        return [
            "width.required" => "Ancho es requerido",
            "width.numeric" => "Ancho debe ser un número",
            "height.required" => "Alto es requerido",
            "height.numeric" => "Alto debe ser un número",
        ];
    }
}
