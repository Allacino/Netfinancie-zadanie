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


Route::get('/zadanie', function () {
    return view('zadanie');
});

Route::get('/vypocet-ceny-ubytovania', function () {
    //todo budem robit TRAIT na vypocet
    return view('vypocet');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users');
//Route::get('/vypocet-ceny', 'UserController@vypocet');
