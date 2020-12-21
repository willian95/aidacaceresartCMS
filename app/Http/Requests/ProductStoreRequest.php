<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            "image" => "required",
            "description" => "required",
            "descriptionEnglish" => "required",
            "scaleImage" => "required"
        ];
    }

    public function messages(){

        return[

            "name.required" => "Titulo del producto es requerido",
            "nameEnglish.required" => "Titulo en inglés del producto es requerido",
            "category.required" => "Categoría del producto es requerido",
            "category.integer" => "Categoría seleccionada no es válida",
            "category.exists" => "Categoría seleccionada no es válida",
            "image.required" => "Imagen del producto es requerido",
            "scaleImage.required" => "Imagen a escala del producto es requerido",
            "description.required" => "Descripción es requerida",
            "descriptionEnglish.required" => "Descripción en inglés es requerido"

        ];

    }
}
