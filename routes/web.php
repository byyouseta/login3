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

//Route::get('/', function () {
//       return view('auth.login');
//});

Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pegawai', 'PegawaiController@index');
Route::get('/agenda', 'HomeController@agenda');
Route::get('/unit', 'HomeController@unit');
//Password
Route::get('/password', 'PasswordController@index');
Route::post('/password/ganti', 'PasswordController@change');