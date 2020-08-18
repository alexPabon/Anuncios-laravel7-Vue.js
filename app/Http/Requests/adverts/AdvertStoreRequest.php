<?php

namespace App\Http\Requests\adverts;

use Illuminate\Foundation\Http\FormRequest;

class AdvertStoreRequest extends FormRequest
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
            'city'=>'required|string|min:4|max:40',
            'product'=>'required|string|min:4|max:50',
            'quantity'=>'required|integer|max:999',
            'price'=>'required|numeric|max:9999999',
            'description'=>'required|string|min:10|max:900',
            'images'=>'array|max:10|',
            'images.*'=>'image|mimes:jpg,jpeg,png,webp',
            'categories'=>'required|array|max:10'
        ];
    }

    public function messages()
    {
        return[
            'city.required'=>'El campo de la ciudad es obligatorio.',
            'city.min'=>'El campo de la ciudad minimo 4 caracteres',
            'city.max'=>'El campo de la ciudad maximo 40 caracteres',

            'product.required'=>'El campo del producto es obligatorio.',
            'product.min'=>'El campo del producto minimo 4 caracteres',
            'product.max'=>'El campo del producto maximo son 50 caracteres',

            'quantity.required'=>'El campo de la cantidad es obligatorio.',
            'quantity.integer'=>'El campo de la cantidad debe ser entero.',
            'quantity.max'=>'El campo de la cantidad maximo son 3 digitos.',

            'price.required'=>'El campo del precio es obligatorio.',
            'price.nemeric'=>'El campo de la cantidd debe ser numerico.',
            'price.max'=>'El campo del precio maximo son 7 digitos.',

            'description.required'=>'El campo de la descripcion es obligatorio.',
            'description.min'=>'El campo de la descripcion minimo 10 caracteres.',
            'description.max'=>'El campo de la descripcion maximo 900 caracteres.',

            'images.array'=>'En imagenes, se esparaba un array',
            'images.max'=>'Maximo 10 Imagenes',

            'images.*.image'=>'La :attribute debe ser una imagen',
            'images.*.mimes'=>'La :attribute debe ser tipo: :values',

            'categories.required'=>'El campo de categorias es obligatorio',
            'categories.array'=>'En categorias, se esparaba un array',
            'categories.max'=>'Maximo 10 categorias',
        ];
    }
}

