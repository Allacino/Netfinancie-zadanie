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


use App\User;

// nemam domovsku stranku tak redirektujem priamo na zadanie
Route::get('/', function () {
    return redirect('/zadanie');
});

Route::get('/zadanie', function () {
    return view('zadanie');
});

Route::get('/test', 'UserController@calculatePrice');

Auth::routes();

// URL pre zadanie 1 a zadanie 2
Route::get('/users', 'UserController@index')->name('users');
Route::get('/vypocet-ceny-ubytovania', 'UserController@vypocetCenyUbytovania');
