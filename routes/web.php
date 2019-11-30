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

	//User
	Route::get('user/datatables', 'UserController@datatables');
	Route::resource('user', 'UserController');
});