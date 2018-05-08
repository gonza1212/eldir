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
Route::get('/no-mostrar', 'HomeController@mejorasVistas')->middleware('auth')->name('no-mostrar');

Route::resource('actividad', 'ActividadController')->middleware('auth');
   Route::get('actividad/{id}/destroy', [
   		'uses' => 'ActividadController@destroy',
   		'as' => 'actividad.destroy'
   	])->middleware('auth');

Route::get('/informe', 'InformeController@index')->name('informe')->middleware('auth');
Route::post('/pasar-actividad', 'InformeController@pasarSobrante')->name('pasar-actividad')->middleware('auth');

Route::prefix('ayuda')->group(function () {
   Route::get('/main', function () {
	    return view('ayuda.main');
	})->name('ayuda.main');
	   Route::get('/version', function () {
	    return view('ayuda.version');
	})->name('ayuda.version');
});

Route::resource('notas', 'NotasController')->middleware('auth');
   Route::get('notas/{id}/destroy', [
      'uses' => 'NotasController@destroy',
      'as' => 'notas.destroy'
    ])->middleware('auth');

Route::resource('persona', 'PersonaController')->middleware('auth');
Route::get('persona/{id}/destroy', [
      'uses' => 'PersonaController@destroy',
      'as' => 'persona.destroy'
    ])->middleware('auth');

Route::resource('visita', 'VisitaController')->middleware('auth');
Route::get('visita/{id}/destroy', [
      'uses' => 'VisitaController@destroy',
      'as' => 'visita.destroy'
    ])->middleware('auth');

Route::resource('revisita', 'RevisitaController')->middleware('auth');
  Route::get('revisita/create/{id}', [
      'uses' => 'RevisitaController@create',
      'as' => 'revisita.create'
    ])->middleware('auth');

  Route::resource('estudio', 'EstudioController')->middleware('auth');
  Route::get('estudio/create/{id}', [
      'uses' => 'EstudioController@create',
      'as' => 'estudio.create'
    ])->middleware('auth');
  Route::get('estudio/convertir/{id}', [
      'uses' => 'EstudioController@convertir',
      'as' => 'estudio.convertir'
    ])->middleware('auth');
  Route::get('estudio/cancelar/{id}', [
      'uses' => 'EstudioController@cancelar',
      'as' => 'estudio.cancelar'
    ])->middleware('auth');

Route::prefix('admin')->group(function () {
Route::resource('users', 'UserController')->middleware('admin');
   Route::get('users/{id}/destroy', [
      'uses' => 'UserController@destroy',
      'as' => 'users.destroy'
    ])->middleware('auth');
});

Route::prefix('opciones')->group(function() {
  Route::get('ajustar-letra', 'ConfigController@ajustarLetra')->middleware('auth')->name('ajustar-letra');
  Route::get('meta', 'ConfigController@meta')->middleware('auth')->name('meta');
  Route::get('ajustar-meta', 'ConfigController@ajustarMeta')->middleware('auth')->name('ajustar-meta');
  Route::post('configurar-meta', 'ConfigController@configurarMeta')->middleware('auth')->name('configurar-meta');
});
