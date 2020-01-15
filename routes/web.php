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
Route::get('/home', 'HomeController@index');
Route::resource('/pembelian', PembelianController::class);
Route::get('/pembelian/get-suplier/{id}', 'PembelianController@getSuplierDetail');
Route::get('/pembelian/get-barang/{id}', 'PembelianController@getBarangDetail');
Route::get('/pembelian/set-status/{id}/{status}', 'PembelianController@setStatus');
