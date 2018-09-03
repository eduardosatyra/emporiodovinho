<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model{
    protected $table = 'venda';  
	protected $primaryKey = 'id_venda';

	public $timestamps = false;
	protected $fillable = [
	'id_cliente','tipo_pagamento', 'data_hora',  'total_venda'
	];

	protected $guarded = [];

}

