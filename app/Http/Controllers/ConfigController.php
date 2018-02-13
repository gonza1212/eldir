<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function ajustarLetra() {
    	\Auth::user()->letra_grande = !\Auth::user()->letra_grande;
    	\Auth::user()->save();
    	return redirect()->route('home');
    }
}
