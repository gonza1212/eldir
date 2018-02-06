<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = "notas";
    protected $fillable = ['titulo', 'contenido',  'user_id'];

    public function user () {
    	return $this->belongsTo('App\User');
    }

    public function scopeBuscarPorUsuario($query, $id) {
        return $query->where('user_id', '=', $id);
    }
    
    public function scopeSearch($query, $titulo) {
        return $query->where('titulo', 'LIKE', "%$titulo%");
    }
}
