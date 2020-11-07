<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormatUpdateRequest extends FormRequest
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
            "name" => "required",
            "nameEnglish" => "required"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "El nombre del formato es requerido",
            "nameEnglish.required" => "Nombre en inglés es requerido"
        ];
    }
}
