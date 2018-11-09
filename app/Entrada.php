<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model {
    protected $table = 'entrada';  
	protected $primaryKey = 'id_entrada';

	public $timestamps = false;
	protected $fillable = [
	'id_fornecedor','tipo_pagamento','data_hora', 'total_entrada'
	];

	protected $guarded = [];

}


