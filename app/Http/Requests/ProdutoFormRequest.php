<?php

namespace emporiodovinho\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoFormRequest extends FormRequest
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
            'id_categoria'=>'required',
            'codigo'=>'required|max:50',
            'nome'=>'required|max:50',
            'estoque'=>'required|numeric',
            'descricao'=>'required|max:512',
            'imagem'=>'mimes:jpeg,bmp,png',
        ];
    }
}
