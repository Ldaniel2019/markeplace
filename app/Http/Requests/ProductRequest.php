<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          =>  'required',
            'description'   =>  'required|min:10',
            'body'          =>  'required|min:20',
            'price'         =>  'required',
            'photos.*'      =>  'image'
            
        ];
    }

    public function messages()
    {
        return [
            'required'   =>  'Este campo é obrigatório',
            'min'        =>  'O valor min é de :min caracteres',
            'image'      =>  'O ficheiro inserido não corresponde a uma imagem valida'
           
        ];
    }
}
