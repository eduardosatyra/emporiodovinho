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
	'sexo',
	'num_documento', 
	'endereco', 
	'telefone', 
	'email',
	'status'

	];

	protected $guarded = [];
}
