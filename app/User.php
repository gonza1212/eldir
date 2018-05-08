<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'profile', 'letra_grande', 'condicion', 'meta', 'periodo_meta', 'meta_activa', 'mejoras_vistas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function actividades() {
        return $this->hasMany('App\Actividad');
    }

    public function notas () {
        return $this->hasMany('App\Nota');
    }

    public function visitas () {
        return $this->hasMany('App\Visita');
    }

    public function admin() {
        return $this->type == 'admin';
    }

    public function meta_activa() {
        return $this->meta_activa == 1;
    }

    public function mejorasNoVistas() {
        return $this->mejoras_vistas == 0;
    }
}
