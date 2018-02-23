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
    	$this->validate($request, ['fecha' => 'required', 'horas' => 'nullable|numeric|max:12|min:0', 'minutos' => 'nullable|numeric|min:0|max:59', 'acompanante' => 'nullable|min:3|max:50', 'publicaciones' => 'nullable|numeric|min:0|max:99', 'videos' => 'nullable|numeric|min:0|max:99', 'revisitas' => 'nullable|numeric|max:99|min:0']);
  		$actividad = new Actividad();
  		$actividad->fecha = Carbon::parse($request->fecha)->hour(1)->minute(2)->second(3);
  		$actividad->horas = isset($request->horas) ? $request->horas : 0;
  		$actividad->minutos = isset($request->minutos) ? $request->minutos : 0;
      if($actividad->horas == 0 && $actividad->minutos == 0) {
        Flash::error('No se puede cargar actividad por 0:00, debe haber predicado algo primero.')->important();
        return view('actividad.create');
      }
      $actividad->acompanante = isset($request->acompanante) ? $request->acompanante : '...';
      $actividad->publicaciones = isset($request->publicaciones) ? $request->publicaciones : 0;
      $actividad->videos = isset($request->videos) ? $request->videos : 0;
      $actividad->revisitas = isset($request->revisitas) ? $request->revisitas : 0;
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

    public function edit($id) {
        $actividad = Actividad::find($id);
        return view('actividad.edit')->with('actividad', $actividad);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['fecha' => 'required', 'horas' => 'nullable|numeric|max:12|min:0', 'minutos' => 'nullable|numeric|min:0|max:59', 'acompanante' => 'nullable|min:3|max:50', 'publicaciones' => 'nullable|numeric|min:0|max:99', 'videos' => 'nullable|numeric|min:0|max:99', 'revisitas' => 'nullable|numeric|max:99|min:0']);
        $actividad = Actividad::find($id);
        $actividad->fecha = Carbon::parse($request->fecha)->hour(1)->minute(2)->second(3);
        $actividad->horas = isset($request->horas) ? $request->horas : 0;
        $actividad->minutos = isset($request->minutos) ? $request->minutos : 0;
        if($actividad->horas == 0 && $actividad->minutos == 0) {
          Flash::error('No se puede cargar actividad por 0:00, debe haber predicado algo primero.')->important();
          return view('actividad.create');
        }
        $actividad->acompanante = isset($request->acompanante) ? $request->acompanante : '...';
        $actividad->publicaciones = isset($request->publicaciones) ? $request->publicaciones : 0;
        $actividad->videos = isset($request->videos) ? $request->videos : 0;
        $actividad->revisitas = isset($request->revisitas) ? $request->revisitas : 0;
        $actividad->user_id = \Auth::user()->id;
        $actividad->save();
        Flash::success("Se ha editado registro del " . $actividad->fecha . " de manera correcta!")->important();
        return redirect()->route('actividad.index');
    }

    
}
