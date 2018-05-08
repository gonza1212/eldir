<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $table = "visitas";
    protected $fillable = ['persona_id', 'fecha', 'tipo', 'tema', 'textos', 'publicacion', 'pendiente', 'observaciones'];

    public function persona () {
        return $this->belongsTo('App\Persona');
    }

    public function isRevisita() {
    	return $this->tipo == 'Revisita';
    }

    public function isEstudio() {
    	return $this->tipo == 'Estudio';
    }
}
