<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = "puntos";
    protected $fillable = ['fecha', 'territorio_id', 'tipo', 'direccion', 'simbolo', 'observaciones'];

    public function territorio () {
        return $this->belongsTo('App\Territorio');
    }
}
