<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Visita;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class EstudioController extends Controller
{
    public function convertir($id) {
    	$persona = Persona::find($id);
    	$persona->estudio = 1;
    	$persona->save();
    	Flash::success('¡' . $persona->nombre . ' es ahora un Estudiante de la Biblia!')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
    }

    public function cancelar($id) {
    	$persona = Persona::find($id);
    	$persona->estudio = 0;
    	$persona->save();
    	Flash::error($persona->nombre . ' ya no es más un Estudiante de la Biblia.')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
    }

    public function create($id) {
    	$persona = Persona::find($id);
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	$ultima = self::obtenerUltimaSesion($persona->visitas);
    	return view('estudio.create', compact('persona', 'publicaciones', 'ultima'));
    }

    public function edit($id) {
    	$sesion = Visita::find($id);
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return view('estudio.edit', compact('sesion', 'publicaciones'));
    }

    public function update(Request $request, $id) {
    	$this->validate($request, ['fecha' => 'required|date|before:tomorrow', 'publicacion' => 'required|min:3|max:60', 'cap' => 'nullable|min:1|max:60', 'parr' => 'nullable|min:1|max:60', 'obs_2' => 'nullable|min:3|max:65535']);
    	$ahora = Carbon::now();
		DB::beginTransaction();
		$visita = Visita::find($id);
		$visita->persona_id = $request->persona_id;
		$visita->fecha = Carbon::parse($request->fecha)->setTime($ahora->hour, $ahora->minute, $ahora->second);
		$visita->publicacion = '$pub:' . $request->publicacion . '$cap:' . $request->cap . '$parr:' . $request->parr;
		$visita->observaciones = $request->obs_2;
		$visita->save();
		DB::commit();
		$persona = Persona::find($request->persona_id);
		Flash::success('La sesión de estudio a ' . $request->nombre . ' se actualizó correctamente!')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
    }

    private function obtenerUltimaSesion($visitas) {
    	if(count($visitas) > 0) {
    		$visitas = $visitas;
    		$sesiones = array();
    		foreach ($visitas as $v) {
    			if($v->isEstudio()) {
    				$sesiones[] = $v;
    			}
    		}
    		self::array_sort_by($sesiones, 'fecha', SORT_DESC);
    		if(count($sesiones) > 0) {
                return $sesiones[0];
            } else {
            return null;
        }
    	} else {
            return null;
        }
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

    public function store(Request $request) {
    	$this->validate($request, ['fecha' => 'required|date|before:tomorrow', 'publicacion' => 'required|min:3|max:60', 'cap' => 'nullable|min:1|max:60', 'parr' => 'nullable|min:1|max:60', 'obs_2' => 'nullable|min:3|max:65535']);
    	$ahora = Carbon::now();
		DB::beginTransaction();
		$visita = new Visita(['persona_id' => $request->persona_id, 'fecha' => Carbon::parse($request->fecha)->setTime($ahora->hour, $ahora->minute, $ahora->second), 'tipo' => 'Estudio', 'publicacion' => '$pub:' . $request->publicacion . '$cap:' . $request->cap . '$parr:' . $request->parr, 'observaciones' => $request->obs_2]);
		$visita->save();
		DB::commit();
		$persona = Persona::find($request->persona_id);
		Flash::success('La sesión de estudio a ' . $request->nombre . ' se registró correctamente!')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
    }


}
