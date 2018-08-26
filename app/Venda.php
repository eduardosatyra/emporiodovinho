<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model{
    protected $table = 'venda';  
	protected $primaryKey = 'id_venda';

	public $timestamps = false;
	protected $fillable = [
	'id_cliente','tipo_comprovante','serie_comprovante', 'num_comprovante', 'data_hora', 'taxa', 'total_venda', 'estado'
	];

	protected $guarded = [];

}

