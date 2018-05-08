<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $table = "informes";
	protected $fillable = ['user_id', 'informado', 'horas_informadas', 'informe_redactado', 'mes_informado', 'year_informado', 'mes_receptor', 'year_receptor'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function scopeBuscarPorMesInformado($query, $user_id, $year, $mes) {
        return $query->where('user_id', '=', $user_id)->where('year_informado', '=', $year)->where('mes_informado', '=', $mes);
    }
}
