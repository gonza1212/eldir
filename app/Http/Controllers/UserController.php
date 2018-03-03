<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Laracasts\Flash\Flash;

/* Este controlador es para el usuario admin y permite realizar las operaciones ABMC sobre la clase User */
class UserController extends Controller
{

     public function __construct(){
        $this->middleware('auth');
    }

	/**
	*  Deveulve la vista para crear un usuario...al parecer (nada mas?? tengo que ver eso despues)
	*/
    public function create() {
    	return view('admin.users.create');
    }

    /**
    * Guarda el usario en la BD
    */
    public function store(Request $request) {
    	$this->validate($request, [ 'name' => 'required|unique:users|min:6|max:40', 'email' => 'required|unique:users|max:255', 'password' => 'required|min:6|max:50']);
    	$user = new User($request->all());
    	$user->password = bcrypt($request->password);
    	$user->type = $request->type;
    	$user->save();
    	Flash::success("Se ha registrado " . $user->name . " de manera correcta!")->important();
    	return redirect()->route('users.index');
    }

	/**
	*	lista todos los usuarios
	*/
    public function index() {
    	$users = User::orderBy('id', 'ASC')->paginate(10);
    	return view('admin.users.index')->with('users', $users);
    }

	/**
	*	Elimina un usuario utilizando el ID recibido como parámetro
	*/
    public function destroy($id) {
    	$user = User::find($id);
    	$user->delete();
    	Flash::error('El usuario ' . $user->name . ' ha sido borrado de manera correcta.')->important();
    	return redirect()->route('users.index');
    }

    /**
	*	Redirecciona a la vista de editar cargando los datos en los campos
	*/
    public function edit($id) {
    	$user = User::find($id);
    	return view('admin.users.edit')->with('user', $user);
    }

    /**
	*	Edita un usuario utilizando el ID recibido como parámetro
	*/
    public function update(Request $request, $id) {
    	$this->validate($request, [ 'name' => 'required|min:6|max:40', 'email' => 'required|max:255|unique:users,email,'.$id, ]);
    	$user = User::find($id);
    	$user->fill($request->all());
    	$user->save();
    	Flash::success("Se ha editado " . $user->name . " de manera correcta!")->important();
    	return redirect()->route('users.index');
    }
}
