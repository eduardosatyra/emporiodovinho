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
            'estoque_minimo'=>'required|numeric',
            'preco_compra'=>'required',
            'preco_venda'=>'required',
            'descricao'=>'required|max:512',            
        ];
    }
}
