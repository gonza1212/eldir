<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Territorio;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;

class TerritorioController extends Controller
{
    public function index() {
        $territorios = Territorio::where('user_id', '=', \Auth::user()->id)->get();
        return view('territorio.index', compact('territorios'));
    }

    public function create() {
        return view('territorio.create');
    }


    public function store(Request $request) {
        $this->validate($request, ['nombre' => 'required|min:1|max:191', 'observaciones' => 'nullable|min:3|max:65535']);
        $territorio = new Territorio();
        $territorio->fill($request->all());
        $territorio->user_id = \Auth::user()->id;
        $territorio->save();
        $territorios = Territorio::where('user_id', '=', \Auth::user()->id)->get();
        Flash::success('El territorio ' . $request->nombre . ' se registró correctamente!')->important();
    	return redirect()->route('territorio.index', compact('territorios'));
    }

    public function edit($id) {
        $territorio = Territorio::find($id);
        return view('territorio.edit', compact('territorio'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['nombre' => 'required|min:1|max:191', 'observaciones' => 'nullable|min:3|max:65535']);
        $territorio = Territorio::find($id);
        $territorio->fill($request->all());
        $territorio->save();
        $territorios = Territorio::where('user_id', '=', \Auth::user()->id)->get();
        Flash::success('El territorio ' . $request->nombre . ' se editó correctamente!')->important();
    	return redirect()->route('territorio.index', compact('territorios'));
    }

    public function destroy($id) {
        $territorio = Territorio::find($id);
        if(count($territorio->puntos) == 0) {
            $territorio->delete();;
            $territorios = Territorio::where('user_id', '=', \Auth::user()->id)->get();
            Flash::error('Se borró el territorio correctamente.')->important();
        } else {
            Flash::error('El territorio tiene puntos cargados. Use la opción <strong>Borrado Agresivo</strong>.')->important();
        }
    	return redirect()->route('territorio.index', compact('territorios'));
    }

    public function destroyAgressive($id) {
        $territorio = Territorio::find($id);
        $territorio->delete();;
        $territorios = Territorio::where('user_id', '=', \Auth::user()->id)->get();
        Flash::error('Se borraron el territorio y sus puntos cargados.')->important();
    	return redirect()->route('territorio.index', compact('territorios'));
    }

    public function show($id) {
        $territorio = Territorio::find($id);
        return view('territorio.show', compact('territorio'));
    }
}
