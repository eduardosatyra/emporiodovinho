<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class DetalheEntrada extends Model {
    protected $table = 'detalhe_entrada';  
	protected $primaryKey = 'id_detalhe_entrada';

	public $timestamps = false;
	protected $fillable = [
	'id_entrada','id_produto', 'quantidade', 'preco_compra', 'preco_venda'
	];

	protected $guarded = [];

}


