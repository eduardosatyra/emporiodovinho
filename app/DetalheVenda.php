<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class DetalheVenda extends Model{
    protected $table = 'detalhe_venda';  
    protected $primaryKey = 'id_detalhe_venda';

    public $timestamps = false;
    protected $fillable = [
    'id_venda','id_produto', 'quantidade', 'preco_venda', 'desconto', 'faturamento'
    ];

    protected $guarded = [];

}