<?php

namespace emporiodovinho\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use emporiodovinho\Http\Requests\Request;

class CategoriaFormRequest extends FormRequest
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
            'nome'=>'required|max:256',
            'descricao'=>'max:256',
        ];
    }
}
