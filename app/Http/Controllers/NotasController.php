<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nota;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class NotasController extends Controller
{
    public function create() {
        return view('notas.create');
    }

    public function index() {
    	$notas = Nota::buscarPorUsuario(\Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
    	return view('notas.index')->with('notas', $notas);
    }

    public function store(Request $request) {
        $this->validate($request, ['titulo' => 'nullable|min:3|max:255', 'contenido' => 'min:3|max:5000|required']);      
        $nota = new Nota($request->all());
        $nota->titulo = isset($request->titulo) ? $request->titulo : 'Nota del ' . Carbon::now();
        $nota->user_id = \Auth::user()->id;
        $nota->save();
        Flash::success('La nota "' . $nota->titulo . '" se creó de manera correcta!')->important();
        return redirect()->route('notas.index');
    }

    public function destroy($id) {
        $nota = Nota::find($id);
        $nota->delete();
        Flash::error("La nota '" . $nota->titulo. "' ha sido borrada de manera correcta.")->important();
        return redirect()->route('notas.index');
    }

    public function edit($id) {
        $nota = Nota::find($id);
        return view('notas.edit')->with('nota', $nota);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['titulo' => 'nullable|min:8|max:255', 'contenido' => 'min:3|max:5000|required']);
        $nota = Nota::find($id);
        $nota->fill($request->all());
        $nota->titulo = isset($request->titulo) ? $request->titulo : 'Nota del ' . Carbon::now();
        $nota->save();
        Flash::success("Se ha editado \"" . $nota->titulo . "\" de manera correcta!")->important();
        return redirect()->route('notas.index');
    }

    public function show($id) {
        $nota = Nota::find($id);
        return view('notas.show')->with('nota', $nota);
    }
}
