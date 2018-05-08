<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Persona;

class PersonaController extends Controller
{
    public function index() {
    	$personas = Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->orderBy('id', 'DESC')->get();
    	return view('persona.index', compact('personas'));
    }

    public function show($id) {
    	$persona = Persona::find($id);
        $publicaciones = Config::get('constants.PUBLICACIONES');
    	return view('persona.show', compact('persona', 'publicaciones'));
    }

    public function edit($id) {
    	$persona = Persona::find($id);
    	return view('persona.edit', compact('persona'));
    }

    public function update(Request $request, $id) {
    	$this->validate($request, ['nombre' => 'required|unique:personas,nombre,'.$id.'|regex:/^[\pL\s\-]+$/u|min:3|max:60', 'calle_1' => 'nullable|min:3|max:50', 'numero' => 'nullable|numeric|min:0|max:32767', 'edad' => 'nullable|numeric|min:3|max:120', 'tel' => 'nullable|min:6|max:25', 'email' => 'nullable|email|min:10|max:80', 'obs' => 'nullable|min:3|max:65535', 'barrio' => 'nullable|min:3|max:50', 'depto' => 'nullable|numeric|min:0|max:32767', 'territorio' => 'nullable|min:1|max:20', 'calle_2' => 'nullable|min:3|max:50', 'entre_a' => 'nullable|min:3|max:48', 'entre_b' => 'nullable|min:3|max:48', 'obs_3' => 'nullable|min:3|max:65535']);
		($request->tema == null || $request->tema == "") ? $request->tema = "Presentación del Mes" : $request->tema = $request->tema;
		DB::beginTransaction();
		$persona = Persona::find($id);
		$persona->fill($request->all());
		$persona->observaciones = $request->obs;
		$persona->save();
		$direccion = $persona->direccion;
		$direccion->fill($request->all());
        $direccion->entre = $request->entre_a . ' y ' . $request->entre_b;
		$direccion->observaciones = $request->obs_3;
		$direccion->save();
		DB::commit();
		Flash::success('Se editó "' . $persona->nombre . '" correctamente!')->important();
    	$publicaciones = Config::get('constants.PUBLICACIONES');
        return view('persona.show', compact('persona', 'publicaciones'));
    }

    public function destroy($id) {
    	$persona = Persona::find($id);
    	$persona->borrado = 1;
    	$persona->save();
    	$personas = Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->get();
    	Flash::error('Se borró "' . $persona->nombre . '" correctamente.')->important();
    	return view('persona.index', compact('personas'));
    }
}
