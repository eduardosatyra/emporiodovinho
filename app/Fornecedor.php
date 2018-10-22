<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedor';  
	protected $primaryKey = 'id_fornecedor';

	public $timestamps = false;
	protected $fillable = [

	'nome',
	'tipo_documento',	
	'num_doc', 
	'endereco',
	'cep',
	'numero',
	'bairro',
	'cidade',
	'estado',
	'complemento', 
	'telefone', 
	'email',
	'status'

	];

	protected $guarded = [];
}
