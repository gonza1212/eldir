<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actividad;
use App\Acompanante;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class ActividadController extends Controller
{
    public function create() {
    	return view('actividad.create');
    }

    public function store(Request $request) {
    	$this->validate($request, ['fecha' => 'required', 'horas' => 'required|numeric|max:24|min:0', 'minutos' => 'nullable|numeric|min:0|max:59', 'acompanante' => 'nullable|min:3|max:50', 'publicaciones' => 'nullable|numeric|min:0|max:99', 'videos' => 'nullable|numeric|min:0|max:99']);
  		$actividad = new Actividad();
  		$actividad->fecha = Carbon::parse($request->fecha)->hour(1)->minute(2)->second(3);
  		$actividad->horas = $request->horas;
  		$actividad->minutos = isset($request->minutos) ? $request->minutos : 0;
      $actividad->acompanante = isset($request->acompanante) ? $request->acompanante : '...';
      $actividad->publicaciones = isset($request->publicaciones) ? $request->publicaciones : 0;
      $actividad->videos = isset($request->videos) ? $request->videos : 0;
  		$actividad->user_id = \Auth::user()->id;
  		$actividad->save();
  		Flash::success('La actividad por ' . $actividad->horas . ':' . $actividad->minutos .'hs se registró correctamente!')->important();
    	return redirect()->route('actividad.index');
    }

    public function index() {
      $actividades = Actividad::buscarPorUsuario(\Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
    	return view('actividad.index')->with('actividades', $actividades);
    }

    public function destroy($id) {
      $actividad = Actividad::find($id);
      $actividad->delete();
      Flash::error('El registro de actividad del ' . Carbon::parse($actividad->fecha)->toFormattedDateString() . ' ha sido borrado de manera correcta.')->important();
      return redirect()->route('actividad.index');
    }

    
}
