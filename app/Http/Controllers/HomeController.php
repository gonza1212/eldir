<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Persona;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

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
    public function index() {
        return view('home');
    }

    public function getUser() {
        $actividades = Actividad::buscarPorUsuario(\Auth::user()->id)->orderBy('id')->get();
        // Define las fechas de los que se calculará 
        $mesActual = Carbon::now()->day(1)->hour(0)->minute(0)->second(0);
        $actuales = Array();
        foreach ($actividades as $a) {
            if(Carbon::parse($a->fecha)->between($mesActual, Carbon::now()->hour(23)->minute(59)->second(59))) {
                $actuales[] = $a;
            }
        }
        $actividadActual = (new InformeController())->calcularActividad($actuales, $mesActual, Carbon::now());
        $veces = 0;
        foreach ($actuales as $a) {
            if($a->acompanante != 'Sobrante del mes pasado' && $a->acompanante != 'Deuda del mes pasado') {
                $veces++;
            }
        }
        $personas = self::ordernarPorUrgencia(Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->get());
        return response()->json(array('actividadActual' => $actividadActual, 'veces' => $veces, 'personas' => $personas), 200);
    }

    private function ordernarPorUrgencia($personas) {
        $visitas;
        //dd($personas);
        $ordenadas = array();
        if(count($personas)) {
            foreach ($personas as $p) {

                if(count($p->visitas)) {
                    $visitas = $p->visitas->toArray();
                    self::array_sort_by($visitas, 'fecha', SORT_DESC);
                    //dd($visitas);
                    $p->visitas = array_replace($p->visitas->toArray(), $visitas);
                    //echo $p->nombre;
                    //print_r($p->visitas);
                }
            }
        }
        $insertar = -1;
        foreach ($personas as $p) {
            if(count($p->visitas)) {
                for($pos=count($ordenadas)-1; $pos>= 0; $pos--) {
                    if(Carbon::parse($p->visitas[0]['fecha'])->lte(Carbon::parse($ordenadas[$pos]->visitas[0]['fecha']))) {
                        //echo $p->visitas[0]['fecha'] . " menor que " . $ordenadas[$pos]->visitas[0]['fecha'];
                        $insertar = $pos;
                    }
                }
                if($insertar < 0) {
                    array_push($ordenadas, $p);
                    //echo 'push: ' . $p->nombre . '-';
                } else {
                    $ordenadas = self::insertar($ordenadas, $p, $insertar);
                    //echo 'insertar '. $p->nombre . ' en pos:' . $insertar . '-';
                    $insertar = -1;
                }
            }
        }
        //dd($ordenadas);
        //echo (count($personas));
        return $ordenadas;
    }

    /**
      Funcion creada por: Eduardo Revilla
      Extraido de: https://reviblog.net/2014/12/05/ordenar-un-array-asociativo-o-de-objetos-por-un-campo-en-php/
    */
    private function array_sort_by(&$arrIni, $col, $order = SORT_ASC) {
        $arrAux = array();
        foreach ($arrIni as $key=> $row) {
            $arrAux[$key] = is_object($row) ? $arrAux[$key] = $row->$col : $row[$col];
            $arrAux[$key] = strtolower($arrAux[$key]);
        }
        array_multisort($arrAux, $order, $arrIni);
    }

    /**
        Funcion creada por: puchitol
        Extraido de: http://www.forosdelweb.com/f18/insertar-elemento-cualquier-posicion-array-480810/
    */
    private function insertar($array,$elemento,$pos) {  
        if($pos < 0) { 
            return; 
        }     
        ## si la posicion es mayor que el tamaño de la lista 
        ## el nodo se inserta al final 
        if($pos>=count($array) ) { 
            array_push($array,$elemento); 
            return; 
        }    
        $listaaux=array(); # array auxiliar 
            ## buscamos la posicion en el array, para ello las posiciones anteriores 
            ## las guardamos en el array auxiliar 
        for($cont=0;$cont<$pos;$cont++) { 
            $listaaux[] = array_shift($array); 
        } 
            ## ahora se inserta el elemento al principio del array original 
        array_unshift($array,$elemento); 
            ## ahora recorremos el array auxiliar desde el final y vamos insertando 
            ## sus elementos al principio del array original 
        if(count($listaaux)>0) { 
            for($i=count($listaaux)-1;$i>=0;$i--) { 
                array_unshift($array,$listaaux[$i]); 
            } 
        }
        return $array;
    }

    public function mejorasVistas() {
        $user = \Auth::user();
        $user->mejoras_vistas = 1;
        $user->save();
        return redirect()->route('home');
    }
}
