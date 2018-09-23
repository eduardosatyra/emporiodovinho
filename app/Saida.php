<?php

namespace emporiodovinho;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model {
    protected $table = 'saida';  
	protected $primaryKey = 'id_saida';

	public $timestamps = false;
	protected $fillable = [
	'id_usuario','data_hora'
	];

	protected $guarded = [];

}


