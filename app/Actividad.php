<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{

	protected $table = "actividades";
	protected $fillable = ['user_id', 'fecha', 'horas', 'minutos', 'acompanante', 'publicaciones', 'videos', 'revisitas'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function scopeBuscarPorUsuario($query, $id) {
        return $query->where('user_id', '=', $id);
    }

    
}
