<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acompanante extends Model
{

	protected $table = "acompanantes";
    protected $fillable = ['nombre', 'user_id'];


     public function scopeBuscarNombre($query, $nombre) {
        return $query->where('nombre', '=', $nombre);
    }
}
