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
    return view('welcome');
});

Auth::routes();

Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('login.github');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('currencies/add', 'CurrencyController@create')->name('currencies.add');
Route::resource('currencies', 'CurrencyController')->except([
    'create'
]);