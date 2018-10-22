<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{protected $table = 'produto';
    protected $primaryKey = 'id_produto';

    public $timestamps = false;
    protected $fillable = [

    'id_categoria',
    'codigo',
    'nome',
    'estoque',
    'estoque_minimo',
    'preco_compra',
    'preco_venda',
    'descricao',    
    'status'

    ];

	protected $guarded = [];
}
