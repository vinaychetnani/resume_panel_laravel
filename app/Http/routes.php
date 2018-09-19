<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/leftRight', ['uses' => 'TryController@leftRight']);
Route::get('/form', ['uses' => 'TryController@showForm']);
Route::post('/parseform', ['uses' => 'TryController@parseForm'])->name('parseform');
Route::get('/try_sp', ['uses' => 'TryController@tryExec']);
Route::post('/pushDatabase', ['uses' => 'TryController@pushDatabase']);

