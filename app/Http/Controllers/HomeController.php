<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::buscarPorUsuario(\Auth::user()->id)->orderBy('id')->get();
        // Define las fechas de los que se calculará 
        $mesactual = Carbon::now()->day(1)->hour(0)->minute(0)->second(0);
        $actuales = Array();
        foreach ($actividades as $a) {
            if(Carbon::parse($a->fecha)->between($mesactual, Carbon::now()->hour(23)->minute(59)->second(59))) {
                $actuales[] = $a;
            }
        }
        $actividadActual = (new InformeController())->calcularActividad($actuales);
        return view('home')->with('actividadActual', $actividadActual)->with('veces', count($actuales));
    }
}
