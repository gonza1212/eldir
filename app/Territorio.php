<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territorio extends Model
{
    protected $table = "territorios";
    protected $fillable = ['user_id', 'nombre', 'observaciones'];

    public function persona () {
        return $this->belongsTo('App\Persona');
    }

    public function puntos() {
        return $this->hasMany('App\Punto');
    }
}
