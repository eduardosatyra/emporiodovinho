<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model {
    protected $table = 'entrada';  
	protected $primaryKey = 'id_entrada';

	public $timestamps = false;
	protected $fillable = [
	'id_fornecedor','tipo_comprovante','serie_comprovante', 'num_comprovante', 'data_hora', 'taxa', 'estado'
	];

	protected $guarded = [];

}


