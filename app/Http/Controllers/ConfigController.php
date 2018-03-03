<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ConfigController extends Controller
{
    public function ajustarLetra() {
    	\Auth::user()->letra_grande = !\Auth::user()->letra_grande;
    	\Auth::user()->save();
    	return redirect()->route('home');
    }

    public function meta() {
    	$condiciones = array('Publicador' => 'Publicador', 'Precursor Auxiliar' => 'Precursor Auxiliar', 'Precursor Regular' => 'Precursor Regular');
    	return view('opciones.meta', compact('condiciones'));
    }

    public function ajustarMeta() {
    	\Auth::user()->meta_activa = !\Auth::user()->meta_activa;
    	\Auth::user()->save();
    	return redirect()->route('meta');
    }

    public function configurarMeta(Request $request) {
    	$this->validate($request, ['condicion' => 'required', 'meta' => 'numeric|min:0|max:1500|required']);
        \Auth::user()->condicion = $request->condicion;
        \Auth::user()->meta = $request->meta;
        \Auth::user()->save();
        Flash::success("¡Se ha configurado la nueva meta por " . $request->meta . "hrs.!")->important();
        return redirect()->route('meta');
    }
}
