<?php

namespace emporiodovinho\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use emporiodovinho\Http\Requests\Request;

class VendaFormRequest extends FormRequest
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
            'id_cliente'=>'required',
            'tipo_pagamento'=>'required|max:20',
            'id_produto'=>'required',
            'quantidade'=>'required',
            'preco_venda'=>'required',            
            'total_atual' => 'required'
        ];
    }
}
