<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class DetalheSaida extends Model {
    protected $table = 'detalhe_saida';  
	protected $primaryKey = 'id_detalhe_saida';

	public $timestamps = false;
	protected $fillable = [
	'id_saida','id_produto', 'quantidade', 'motivo'
	];

	protected $guarded = [];

}


