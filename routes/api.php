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
Route::get('/eventos', 'EventController@store');

Route::resource('proyectos', 'ProjectController');
//Route::resource('estados', 'StateController');
Route::resource('eventos', 'EventController');

//Route::resource('categorias', 'CategoryController',['only'=>['index','show']]);
//Route::resource('proyectos.categorias', 'ProjectCategoryController',['except'=>['show']]);


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
