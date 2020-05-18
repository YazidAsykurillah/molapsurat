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
	Route::get('surat-tugas/export', 'SuratTugasController@export');
	Route::post('surat-tugas/delete', 'SuratTugasController@delete');
	Route::get('surat-tugas/monitoring-datatables', 'SuratTugasController@MonitoringDatatables');
	Route::get('surat-tugas/datatables', 'SuratTugasController@datatables');
	Route::get('surat-tugas/monitoring', 'SuratTugasController@monitoring');
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
	Route::post('user/import', 'UserController@import');
	Route::get('user/import', 'UserController@renderImportView');
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

	//Pagu Tahunan
	Route::get('pagu-tahunan/datatables', 'PaguTahunanController@datatables');
	Route::resource('pagu-tahunan', 'PaguTahunanController');

	//Pengajuan Keuangan
	Route::get('pengajuan-keuangan/select2JenisSuratTugas', 'PengajuanKeuanganController@select2JenisSuratTugas');
	Route::get('pengajuan-keuangan/datatables', 'PengajuanKeuanganController@datatables');
	Route::resource('pengajuan-keuangan', 'PengajuanKeuanganController');

	//Realisasi Keuangan
	Route::get('realisasi-keuangan/datatables', 'RealisasiKeuanganController@datatables');
	Route::post('realisasi-keuangan/store', 'RealisasiKeuanganController@store');
	Route::resource('realisasi-keuangan', 'RealisasiKeuanganController');


	Route::get('chart-data-anggaran', 'HomeController@getChartDataAnggaran');

});