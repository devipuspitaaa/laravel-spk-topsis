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

Route::get('/','userController@tampilAwal');
Route::get('/login','loginController@loginForm');
Route::post('/login','loginController@cekLogin');
Route::get('/logout','loginController@logout');

Route::group(['middleware' => 'login.auth'], function(){
	Route::prefix('admin')->group(function(){
		Route::get('/home','loginController@home');

		Route::get('/motor/list','controllerMotor@listMotor');
		Route::get('/motor/form','controllerMotor@formMotor');
		Route::post('/motor/form','controllerMotor@simpanMotor');
		Route::get('/motor/{id}/edit','controllerMotor@editForm');
		Route::post('/motor/{id}/edit','controllerMotor@simpanEdit');
		Route::get('/motor/{id}/hapus','controllerMotor@hapusMotor');

		Route::get('/kriteria/list','kriteriaController@listKriteria');
		Route::get('/kriteria/form/{id}','kriteriaController@form');
		Route::post('/kriteria/form/{id}','kriteriaController@simpanForm');

		Route::get('/penilaian/list','nilaiController@listNilai');
		Route::get('/penilaian/form/{id}','nilaiController@form');
		Route::post('/penilaian/form/{id}','nilaiController@simpanForm');
		Route::get('/penilaian/{id}/edit','nilaiController@formEdit');
		Route::post('/penilaian/{id}/edit','nilaiController@simpanFormEdit');

		Route::get('/ubahSandi/{id}','loginController@formSandi');
		Route::post('/ubahSandi/{id}','loginController@simpanSandi');

		// laporan sepeda motor
		Route::get('/laporan/motor','laporanController@lapMotor');
		Route::get('/laporan/motor/preview/{cari}','laporanController@previewMotor');
		Route::get('/laporan/motor/excel/{cari}','laporanController@excelMotor');

		// laporan kriteria
		Route::get('/laporan/kriteria','laporanController@lapKriteria');
		Route::get('/laporan/kriteria/preview','laporanController@previewKriteria');
		Route::get('/laporan/kriteria/excel','laporanController@excelKriteria');

		// laporan penilaian
		Route::get('/laporan/penilaian','laporanController@lapPenilaian');
		Route::get('/laporan/penilaian/preview/{cari}','laporanController@previewPenilaian');
		Route::get('/laporan/penilaian/excel/{cari}','laporanController@excelPenilaian');

		// laporan pilihan user
		Route::get('/laporan/piluser','laporanController@lapUser');
		Route::get('/laporan/piluser/{bulan}/{tahun}','laporanController@previewUser');
		Route::get('/laporan/piluser/excel/{bulan}/{tahun}','laporanController@excelUser');

		// laporan topsis admin
		Route::get('/topsisadmin','topsisController@topsisAdmin');
		Route::get('/laporan/topsis/preview','laporanController@previewTopsis');
		Route::get('/laporan/topsis/excel','laporanController@excelTopsis');
	});
});

Route::get('/pemilihan','userController@pemilihan');
Route::post('/pemilihan','topsisController@topsis');
Route::get('/pemilihan/{id}/detail','userController@detail');
Route::post('/kontak','userController@kontak');