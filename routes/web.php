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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

	//Jenis Surat Tugas
	Route::post('jenis-surat-tugas/delete', 'JenisSuratTugasController@delete');
	Route::get('jenis-surat-tugas/datatables', 'JenisSuratTugasController@datatables');
	Route::get('jenis-surat-tugas/select2', 'JenisSuratTugasController@select2');
	Route::resource('jenis-surat-tugas','JenisSuratTugasController');

	//Tujuan Surat Tugas
	Route::post('tujuan-surat-tugas/delete', 'TujuanSuratTugasController@delete');
	Route::get('tujuan-surat-tugas/datatables', 'TujuanSuratTugasController@datatables');
	Route::get('tujuan-surat-tugas/select2', 'TujuanSuratTugasController@select2');
	Route::resource('tujuan-surat-tugas', 'TujuanSuratTugasController');

	//Surat Tugas
	Route::post('surat-tugas/delete', 'SuratTugasController@delete');
	Route::get('surat-tugas/datatables', 'SuratTugasController@datatables');
	Route::resource('surat-tugas', 'SuratTugasController');

	//Laporan Surat Tugas
	Route::post('laporan-surat-tugas/delete', 'LaporanSuratTugasController@delete');
	Route::post('laporan-surat-tugas/{id}/complete', 'LaporanSuratTugasController@complete');
	Route::post('laporan-surat-tugas/{id}/approve-by-tu-ses', 'LaporanSuratTugasController@approveByTUSes');
	Route::post('laporan-surat-tugas/{id}/approve-by-inspektur', 'LaporanSuratTugasController@approveByInspektur');
	Route::post('laporan-surat-tugas/{id}/approve-by-kasubag-tu', 'LaporanSuratTugasController@approveByKasubagTU');
	Route::get('laporan-surat-tugas/select2SuratTugas', 'LaporanSuratTugasController@select2SuratTugas');
	Route::get('laporan-surat-tugas/datatables', 'LaporanSuratTugasController@datatables');
	Route::resource('laporan-surat-tugas', 'LaporanSuratTugasController');

	//User
	Route::get('user/select2', 'UserController@select2');
	Route::get('user/datatables', 'UserController@datatables');
	Route::resource('user', 'UserController');

	//Role
	Route::post('update-role-permission', 'RoleController@updateRolePermission');
	Route::get('role/datatables', 'RoleController@datatables');
	Route::resource('role', 'RoleController');

	//Permission
	Route::get('permission/datatables', 'PermissionController@datatables');
	Route::resource('permission', 'PermissionController');


	//Keuangan
	Route::get('keuangan/pagu-tahunan', 'PaguTahunanController@index');

	//Pagu Tahunan
	Route::get('pagu-tahunan/datatables', 'PaguTahunanController@datatables');
	Route::resource('pagu-tahunan', 'PaguTahunanController');


});