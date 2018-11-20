<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table = 'categoria';  
	protected $primaryKey = 'id_categoria';

	public $timestamps = false;
	protected $fillable = [

	'nome','condicao'

	];

	protected $guarded = [];

}
