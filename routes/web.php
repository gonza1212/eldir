<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('actividad', 'ActividadController')->middleware('auth');
   Route::get('actividad/{id}/destroy', [
   		'uses' => 'ActividadController@destroy',
   		'as' => 'actividad.destroy'
   	])->middleware('auth');

Route::get('/informe', 'InformeController@index')->name('informe')->middleware('auth');

Route::prefix('ayuda')->group(function () {
   Route::get('/main', function () {
	    return view('ayuda.main');
	})->name('ayuda.main');
	   Route::get('/version', function () {
	    return view('ayuda.version');
	})->name('ayuda.version');
});

Route::resource('revisita', 'RevisitaController')->middleware('auth');

Route::prefix('admin')->group(function () {
Route::resource('users', 'UserController')->middleware('admin');
   Route::get('users/{id}/destroy', [
      'uses' => 'UserController@destroy',
      'as' => 'users.destroy'
    ])->middleware('auth');
});
