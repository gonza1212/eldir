<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use App\Visita;
use App\Persona;
use Carbon\Carbon;

class RevisitaController extends Controller
{
    public function create($id) {
    	$persona = Persona::find($id);
    	$visitas = $persona->visitas;
        if(count($visitas)) {
        	$pendiente = $visitas[count($visitas) - 1]->pendiente;
        } else {
            $pendiente = '';
        }
    	return view('revisita.create', compact('persona', 'pendiente'));
    }

    public function store(Request $request) {
    	$this->validate($request, ['fecha' => 'required|unique:visitas,fecha,NULL,NULL,tema,'.$request['tema'].'|date|before:tomorrow', 'tema' => 'required|unique:visitas,tema,NULL,NULL,fecha,'.$request['fecha'].'|min:3|max:191', 'textos' => 'nullable|min:3|max:191', 'publicacion' => 'nullable|min:3|max:191', 'pendiente' => 'nullable|min:3|max:191', 'obs_2' => 'nullable|min:3|max:65535']);
		($request->tema == null || $request->tema == "") ? $request->tema = "Presentación del Mes" : $request->tema = $request->tema;
		$ahora = Carbon::now();
		DB::beginTransaction();
		$visita = new Visita(['persona_id' => $request->persona_id, 'fecha' => Carbon::parse($request->fecha)->setTime($ahora->hour, $ahora->minute, $ahora->second), 'tipo' => 'Revisita', 'tema' => $request->tema, 'textos' => $request->textos, 'publicacion' => $request->publicacion, 'pendiente' => $request->pendiente, 'observaciones' => $request->obs_2]);
		$visita->save();
		DB::commit();
		$personas = Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->orderBy('id', 'DESC')->get();
		Flash::success('La revisita a ' . $request->nombre . ' se registró correctamente!')->important();
    	return redirect()->route('persona.index', compact('personas'));
    }

    public function index() {
        $personas = Persona::where('user_id', '=', \Auth::user()->id)->where('borrado', '=', 0)->orderBy('id', 'DESC')->get();
        return view('revisita.index', compact('personas'));
    }
}
