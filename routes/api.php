<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('proyectos', 'ProjectController');
//Route::resource('estados', 'StateController');
Route::post("agenda", "AgendaController@store");
Route::post("agenda/proyecto", "AgendaController@proyecto");

//Eventos
Route::resource('eventos', 'EventController');
Route::post("eventos/dia","EventController@getEvents");
Route::resource('eventos.proyectos', 'Event/EventProjectController',['only'=>['index']]);


//Proyectos
Route::resource('proyectos.eventos', 'ProjectEventController',['except'=>['show']]);

Route::resource('categorias', 'CategoryController',['only'=>['index','show']]);
Route::resource('proyectos.categorias', 'ProjectCategoryController',['except'=>['show']]);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
