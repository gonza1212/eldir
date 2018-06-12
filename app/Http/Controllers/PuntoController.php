<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use App\Punto;
use App\Territorio;

class PuntoController extends Controller
{
    public function create($id) {
        $territorio_id = $id;
        $tipos = Config::get('constants.TIPOS');
        $simbolos = Config::get('constants.SIMBOLOS');
        return view('punto.create', compact('territorio_id', 'tipos', 'simbolos'));
    }

    public function store(Request $request) {
        $this->validate($request, ['fecha' => 'required|date|before:tomorrow', 'tipo' => 'required|string|min:3|max:30', 'direccion' => 'nullable|min:3|max:191', 'simbolo' => 'required|string|min:1|max:3', 'observaciones' => 'nullable|min:3|max:191']);
        $punto = new Punto();
        $punto->fill($request->all());
        $punto->save();
    	$territorio = Territorio::find($request->territorio_id);
        Flash::success('El punto se registró correctamente!')->important();
        return redirect()->route('territorio.show', compact('territorio'));
    }

    public function edit($id) {
        $punto = Punto::find($id);
        $territorio_id = $punto->territorio_id;
        $tipos = Config::get('constants.TIPOS');
        $simbolos = Config::get('constants.SIMBOLOS');
        return view('punto.edit', compact('punto', 'territorio_id', 'tipos', 'simbolos'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['fecha' => 'required|date|before:tomorrow', 'tipo' => 'required|string|min:3|max:30', 'direccion' => 'nullable|min:3|max:191', 'simbolo' => 'required|string|min:1|max:3', 'observaciones' => 'nullable|min:3|max:191']);
        $punto = Punto::find($id);
        $punto->fill($request->all());
        $punto->save();
        $territorio = Territorio::find($request->territorio_id);
        Flash::success('El punto se editó correctamente!')->important();
        return redirect()->route('territorio.show', compact('territorio'));
    }

    public function destroy($id) {
        $punto = Punto::find($id);
        $territorio = Territorio::find($punto->territorio_id);
        $punto->delete();
        Flash::error('El punto se borró correctamente!')->important();
        return redirect()->route('territorio.show', compact('territorio'));
    }
}
