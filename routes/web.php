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

//Password
Route::get('/password', 'PasswordController@index');
Route::post('/password/ganti', 'PasswordController@change');
//Pegawai
Route::get('/pegawai', 'PegawaiController@index');
Route::get('/pegawai/tambah', 'PegawaiController@tambah');
Route::post('/pegawai/tambahpegawai', 'PegawaiController@tambahpegawai');
Route::get('/pegawai/edit/{id}', 'PegawaiController@edit');
Route::post('/pegawai/update/{id}', 'PegawaiController@update');
Route::get('/pegawai/hapus/{id}', 'PegawaiController@delete');
//Unit
Route::get('/unit', 'UnitController@index');
Route::get('/unit/tambah', 'UnitController@tambah');
Route::post('/unit/tambahunit', 'UnitController@tambahunit');
Route::get('/unit/edit/{id}', 'UnitController@edit');
Route::put('/unit/update/{id}', 'UnitController@update');
Route::get('/unit/hapus/{id}', 'UnitController@delete');
//Ruangan
Route::get('/ruangan', 'RuanganController@index');
Route::get('/ruangan/tambah', 'RuanganController@tambah');
Route::post('/ruangan/tambahruangan', 'RuanganController@tambahruangan');
Route::get('/ruangan/edit/{id}', 'RuanganController@edit');
Route::put('/ruangan/update/{id}', 'RuanganController@update');
Route::get('/ruangan/hapus/{id}', 'RuanganController@delete');
//Agenda
Route::get('/agenda', 'AgendaController@index');
Route::get('/agenda/tambah', 'AgendaController@tambah');
Route::post('/agenda/tambahagenda', 'AgendaController@tambahagenda');
Route::get('/agenda/hapus/{id}', 'AgendaController@delete');
Route::get('/agenda/edit/{id}', 'AgendaController@edit');
Route::post('/agenda/update/{id}', 'AgendaController@update');
//Undangan
Route::get('/agenda/undangan/{id}', 'AgendaController@undangan');
Route::post('/undangan/tambahpeserta/{id}', 'AgendaController@tambahpeserta');
Route::get('/undangan/{id}/hapus/{ids}', 'AgendaController@deleteundangan');
//Presensi
Route::get('/presensi/undangan/{id}', 'PresensiController@index');