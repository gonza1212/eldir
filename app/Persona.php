<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = "personas";
    protected $fillable = ['user_id', 'nombre', 'edad', 'estudio', 'telefono', 'email', 'observaciones'];

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function visitas () {
    	return $this->hasMany('App\Visita');
    }

    public function direccion () {
        return $this->hasOne('App\Direccion');
    }

    public function isEstudio() {
        return $this->estudio == 1;
    }
}
