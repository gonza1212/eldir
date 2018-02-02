<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RevisitaController extends Controller
{
    public function create() {
    	return view('revisitas.create');
    }
}
