<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';  
	protected $primaryKey = 'id_cliente';

	public $timestamps = false;
	protected $fillable = [

	'nome',
	'tipo_documento',	
	'num_doc', 	
	'telefone', 
	'email', 	

	];

	protected $guarded = [];
}
