<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use Carbon\Carbon;

class InformeController extends Controller
{

	public function __construct() {
		Carbon::setLocale('es');
	}

    public function index() {
    	$actividades = Actividad::buscarPorUsuario(\Auth::user()->id)->orderBy('id')->get();
    	$meses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    	// Define las fechas de los que se calculará 
		$mesactual = Carbon::now()->day(1)->hour(0)->minute(0)->second(0);
		$mespasado = Carbon::now()->subMonth()->day(1)->hour(0)->minute(0)->second(0);
		$actuales = Array();
		$pasadas = Array();
		foreach ($actividades as $a) {
			if(Carbon::parse($a->fecha)->between($mesactual, Carbon::now()->hour(23)->minute(59)->second(59))) {
				$actuales[] = $a;
			} else if(Carbon::parse($a->fecha)->between($mespasado, $mesactual)) {
				$pasadas[] = $a;
			}
		}
		$actividadActual = $this->calcularActividad($actuales);
		$actividadPasada = $this->calcularActividad($pasadas);
		return view('informe.index')->with('actuales', $actuales)->with('pasadas', $pasadas)->with('meses', $meses)->with('hoy', $mesactual)->with('actividadActual', $actividadActual)->with('actividadPasada', $actividadPasada);
    }

    public function calcularActividad($actividades) {
    	$actividad = Array();
    	$horas = 0;
		$minutos = 0;
		$publicaciones = 0;
		$videos = 0;
		$revisitas = 0;
		foreach ($actividades as $a) {
			$horas += $a->horas;
			$minutos += $a->minutos;
			$publicaciones += $a->publicaciones;
			$videos += $a->videos;
			$revisitas += $a->revisitas;
		}
		$horas += intdiv($minutos, 60);
		$minutos = $minutos%60;
		$actividad[] = $horas;
		$actividad[] = $minutos;
		$actividad[] = $publicaciones;
		$actividad[] = $videos;
		$actividad[] = $revisitas;
		return $actividad;
    }
}
