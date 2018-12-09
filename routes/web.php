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

// Route::get('/', function () {
// 	return view('welcome');
// });

Auth::routes();




/**
 * Route for cetak data.
 */
Route::get('peminjaman/{id}/cetak',[
	'as' => 'peminjaman.cetak',
	'uses' => 'PeminjamanController@cetak',

]);

Route::get('angsuran/{id}/cetak',[
	'as' => 'angsuran.cetak',
	'uses' => 'AngsuranController@cetak',

]);
Route::get('simpanan_wajib/{id}/cetak',[
	'as' => 'simpanan_wajib.cetak',
	'uses' => 'SimpananWajibController@cetak',

]);
Route::get('simpanan_pokok/{id}/cetak',[
	'as' => 'simpanan_pokok.cetak',
	'uses' => 'SimpananPokokController@cetak',

]);

Route::get('ambil_simpanan/{id}/cetak',[
	'as' => 'ambil_simpanan.cetak',
	'uses' => 'AmbilSimpananController@cetak',

]);

/**
 * End of Route for cetak data
 */

Route::match(['GET', 'POST'],'laporan/generate_laporan',[
	'as' => 'laporan.generate_laporan',
	'uses' => 'LaporanController@generate_laporan',

]);
Route::get('peminjaman/{id}/angsur',[
	'as' => 'peminjaman.angsur',
	'uses' => 'PeminjamanController@angsur',

]);


Route::get('daftar',[
	'as' => 'anggota.daftar',
	'uses' => 'AnggotaController@daftar',

]);
Route::get('anggota/index_verifikasi',[
	'as' => 'anggota.index_verifikasi',
	'uses' => 'AnggotaController@index_verifikasi',

]);

Route::post('anggota/verifikasi',[
	'as' => 'anggota.verifikasi',
	'uses' => 'AnggotaController@verifikasi',

]);


Route::post('anggota/hapus',[
	'as' => 'anggota.hapus',
	'uses' => 'AnggotaController@hapus',

]);
Route::resource('anggota', 'AnggotaController');
Route::resource('users', 'UserController');
Route::resource('simpanan_wajib', 'SimpananWajibController');
Route::resource('simpanan_pokok', 'SimpananPokokController');
Route::resource('ambil_simpanan', 'AmbilSimpananController');
Route::resource('peminjaman', 'PeminjamanController');
Route::resource('angsuran', 'AngsuranController');
Route::resource('laporan', 'LaporanController');
Route::resource('profile', 'ProfileController');


Route::group(['middleware' => ['auth']], function() {
	
	Route::get('/', 'DashboardController@index');


	Route::group(['middleware' => ['role:admin']], function() {
		

	});

	Route::group(['middleware' => ['role:ketua']], function() {
		

	});
	Route::group(['middleware' => ['role:anggota']], function() {
		

	});


});


