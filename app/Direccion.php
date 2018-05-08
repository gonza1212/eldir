<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = "direcciones";
	protected $fillable = ['persona_id', 'localidad', 'calle_1', 'calle_2', 'entre', 'numero', 'depto', 'barrio', 'territorio', 'observaciones'];

	public function persona () {
    	return $this->belongsTo('App\Persona');
    }
}
