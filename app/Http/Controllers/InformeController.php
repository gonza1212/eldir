<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Informe;
use App\Persona;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class InformeController extends Controller
{

	public function __construct() {
		Carbon::setLocale('es');
	}

    public function index() {
    	$actividades = Actividad::buscarPorUsuario(\Auth::user()->id)->orderBy('id')->get();
    	$meses = Config::get('constants.MESES');
    	// Define las fechas de los que se calculará 
		$mesActual = Carbon::now()->day(1)->hour(0)->minute(0)->second(0);
		$mespasado = Carbon::now()->subMonth()->day(1)->hour(0)->minute(0)->second(0);
		$actuales = Array();
		$pasadas = Array();
		foreach ($actividades as $a) {
			if(Carbon::parse($a->fecha)->between($mesActual, Carbon::now()->hour(23)->minute(59)->second(59))) {
				$actuales[] = $a;
			} else if(Carbon::parse($a->fecha)->between($mespasado, $mesActual)) {
				$pasadas[] = $a;
			}
		}
		$actividadActual = $this->calcularActividad($actuales, $mesActual, Carbon::now());
		$actividadPasada = $this->calcularActividad($pasadas, $mespasado, $mesActual);
		if(count($pasadas)) {
			$informe = Informe::buscarPorMesInformado(\Auth::user()->id, Carbon::parse($pasadas[0]->fecha)->year, Carbon::parse($pasadas[0]->fecha)->month)->get();			
		}
		return view('informe.index', compact('actuales', 'pasadas', 'meses', 'mesActual', 'actividadActual', 'actividadPasada', 'informe'));
    }

    public function calcularActividad($actividades, $limiteInferior, $limiteSuperior) {
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
		if($minutos < 0) {
			$minutos += 60;
			$horas--;
		}
		$horas += intdiv($minutos, 60);
		$minutos = $minutos%60;
		$revisitasEstudios = $this->calcularRevisitasYEstudios(Persona::where('user_id', '=', \Auth::user()->id)->get(), $limiteInferior, $limiteSuperior);
		$actividad[] = $horas;
		$actividad[] = $minutos;
		$actividad[] = $publicaciones;
		$actividad[] = $videos;
		$actividad[] = $revisitas + $revisitasEstudios[0];
		$actividad[] = $revisitasEstudios[1];
		return $actividad;
    }

    private function calcularRevisitasYEstudios($personas, $limiteInferior, $limiteSuperior) {
    	$revisitasEstudios = array();
    	$revisitas = 0;
    	$estudios = 0;
    	foreach ($personas as $p) {
    		$esEstudio = false;
    		if(count($p->visitas)) {
    			foreach ($p->visitas as $v) {
					if(Carbon::parse($v->fecha)->between($limiteInferior, $limiteSuperior->hour(23)->minute(59)->second(59)) && ($v->isRevisita() || $v->isEstudio())) {
	    				$revisitas++;
						if($v->isEstudio()) {
							$esEstudio = true;
						}
					}
    			}
    		}
    		if($esEstudio) {
    			$estudios++;
    		}
    	}
    	$revisitasEstudios[] = $revisitas;
    	$revisitasEstudios[] = $estudios;
    	return $revisitasEstudios;
    }

    public function pasarSobrante(Request $request) {
    	$this->validate($request, ['informado' => 'numeric|max:199|min:0|required']);
    	$diferencia_horas = intval($request->predicado_horas) - $request->informado;
    	if($diferencia_horas >= 0) {
    		$actividad = new Actividad(['user_id' => \Auth::user()->id, 'fecha' => Carbon::now(), 'horas' => $diferencia_horas, 'minutos' => intval($request->predicado_min), 'acompanante' => 'Sobrante del mes pasado']);    		
    	} else {
    		$actividad = new Actividad(['user_id' => \Auth::user()->id, 'fecha' => Carbon::now(), 'horas' => ++$diferencia_horas, 'minutos' => -(60-intval($request->predicado_min)), 'acompanante' => 'Deuda del mes pasado']);
    	}    	
    	$informe = new Informe(['user_id' => \Auth::user()->id, 'informado' => 1, 'horas_informadas' => $request->informado, 'informe_redactado' => $request->informe_redactado, 'mes_informado' => (Carbon::now()->subMonth())->month, 'year_informado' => (Carbon::now()->subMonth())->year, 'mes_receptor' => Carbon::now()->month, 'year_receptor' => Carbon::now()->year]);
    	$actividad->save();
    	$informe->save();
    	Flash::success("Se guardó el informe y se pasó la actividad al mes en curso.")->important();
    	return redirect()->route('informe');
    }
}
