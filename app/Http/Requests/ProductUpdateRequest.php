<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            "name" => "required",
            "nameEnglish" => "required",
            "category" => "required|integer|exists:categories,id",
            "description" => "required",
            "descriptionEnglish" => "required"
        ];
    }

    public function messages(){

        return[

            "name.required" => "Titulo del producto es requerido",
            "nameEnglish.required" => "Titulo en inglés del producto es requerido",
            "category.required" => "Categoría del producto es requerido",
            "category.integer" => "Categoría seleccionada no es válida",
            "category.exists" => "Categoría seleccionada no es válida",
            "description.required" => "Descripción es requerida",
            "descriptionEnglish.required" => "Descripción en inglés es requerido"

        ];

    }
}
