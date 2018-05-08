<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;
use App\Direccion;
use App\Persona;
use App\Visita;

class VisitaController extends Controller
{
	public function create() {
		$personas = Persona::where('user_id', '=', \Auth::user()->id)->get();
		$direcciones = array();
		foreach ($personas as $p) {
			$direcciones[] = $p->direccion;	
		}
		return view('visita.create', compact('direcciones'));
	}

	public function store(Request $request) {
		$this->validate($request, ['fecha' => 'required|date|before:tomorrow', 'nombre' => 'required|unique:personas|regex:/^[\pL\s\-]+$/u|min:3|max:60', 'calle_1' => 'required|min:3|max:50', 'numero' => 'nullable|numeric|min:0|max:32767', 'edad' => 'nullable|numeric|min:3|max:120', 'tel' => 'nullable|min:6|max:25', 'email' => 'nullable|email|min:10|max:80', 'obs' => 'nullable|min:3|max:65535', 'barrio' => 'nullable|min:3|max:50', 'depto' => 'nullable|numeric|min:0|max:32767', 'territorio' => 'nullable|min:1|max:20', 'calle_2' => 'nullable|min:3|max:50', 'entre_a' => 'nullable|min:3|max:48', 'entre_b' => 'nullable|min:3|max:48', 'obs_3' => 'nullable|min:3|max:65535', 'tema' => 'nullable|min:3|max:191', 'textos' => 'nullable|min:3|max:191', 'publicacion' => 'nullable|min:3|max:191', 'pendiente' => 'nullable|min:3|max:191', 'obs_2' => 'nullable|min:3|max:65535']);
		($request->tema == null || $request->tema == "") ? $request->tema = "Presentación del Mes" : $request->tema = $request->tema;
		$ahora = Carbon::now();
		DB::beginTransaction();
		$persona = new Persona(['user_id' => \Auth::user()->id, 'nombre' => $request->nombre, 'edad' => $request->edad, 'telefono' => $request->tel, 'email' => $request->email, 'observaciones' => $request->obs]);
		$persona->save();
		$direccion = new Direccion(['persona_id' => $persona->id, 'calle_1' => $request->calle_1, 'calle_2' => $request->calle_2, 'entre' => $request->entre_a . ' y ' . $request->entre_b, 'numero' => $request->numero, 'depto' => $request->depto, 'barrio' => $request->barrio, 'territorio' => $request->territorio, 'observaciones' => $request->obs_3]);
		$direccion->save();
		$visita = new Visita(['persona_id' => $persona->id, 'fecha' => Carbon::parse($request->fecha)->setTime($ahora->hour, $ahora->minute, $ahora->second), 'tipo' => $request->tipo, 'tema' => $request->tema, 'textos' => $request->textos, 'publicacion' => $request->publicacion, 'pendiente' => $request->pendiente, 'observaciones' => $request->obs_2]);
		$visita->save();
		DB::commit();
		$personas = Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->get();
		Flash::success('La visita a ' . $persona->nombre . ' se registró correctamente!')->important();
    	return redirect()->route('persona.index', compact('personas'));
	}

	public function edit($id) {
		$visita = Visita::find($id);
		return view('visita.edit', compact('visita'));
	}

	public function update(Request $request, $id) {
		$this->validate($request, ['fecha' => 'required|date', 'tema' => 'nullable|min:3|max:191', 'textos' => 'nullable|min:3|max:191', 'publicacion' => 'nullable|min:3|max:191', 'pendiente' => 'nullable|min:3|max:191', 'obs_2' => 'nullable|min:3|max:65535']);
		($request->tema == null || $request->tema == "") ? $request->tema = "Presentación del Mes" : $request->tema = $request->tema;
		$ahora = Carbon::now();
		DB::beginTransaction();
		$visita = Visita::find($id);
		$visita->fill($request->all());
		$visita->observaciones = $request->obs_2;
		$visita->save();
		DB::commit();
		$persona = $visita->persona;
		Flash::success('Se editó la visita a "' . $persona->nombre . '" correctamente!')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
	}

	public function destroy($id) {
    	$visita = Visita::find($id);
    	$persona = $visita->persona;
		DB::beginTransaction();
    	$visita->delete();
		DB::commit();
    	Flash::error('Se borró la visita a "' . $persona->nombre . '" correctamente.')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
    	return redirect()->route('persona.show', compact('persona', 'publicaciones'));
    }

    public function show($id) {
    	
    }
}
