<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            "title" => "required",
            "englishTitle" => "required",
            "description" => "required",
            "englishDescription" => "required",
            "date" => "required|date"
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "Titulo es requerido",
            "englishTitle.required" => "Titulo en inglés es requerido",
            "description.required" => "Descripción es requerida",
            "englishDescription.required" => "escripción en inglés es requerido",
            "date.requried" => "Fecha es requerida",
            "date.date" => "Fecha es inválida"
        ];
    }
}
