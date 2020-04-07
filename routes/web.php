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

Route::get('/login', 'UserLogController@index');
Route::post('/login', 'UserLogController@login');
Route::get('/', 'HomeController@index');
Route::get('/get-penjualan-pembelian/{start}/{end}', 'HomeController@getPenjualanPembelianNHari');
Route::get('/get-penjualan-pembelian/{date}', 'HomeController@getPenjualanPembelian1Hari');
Route::get('/get-penjualan-pembelian', 'HomeController@getPenjualanPembelianLifetime');

Route::resource('/pembelian', PembelianController::class);
Route::get('/pembelian/get-suplier/{id}', 'PembelianController@getSuplierDetail');
Route::get('/pembelian/get-barang/{id}', 'PembelianController@getBarangDetail');
Route::get('/pembelian/set-status/{id}/{status}', 'PembelianController@setStatus');
Route::get('/pembelian/cek-kapasitas-gudang/{id}', 'PembelianController@getKapasitasSubLokasi');
Route::get('/pembelian/index/{page}/{load}', 'PembelianController@indexPage');

Route::resource('/penjualan', PenjualanController::class);
Route::get('/penjualan/get-pelanggan/{id}', 'PenjualanController@getPelangganDetail');
Route::get('/penjualan/get-sales/{id}', 'PenjualanController@getSalesDetail');
Route::get('/penjualan/set-status-barang-penjualan/{id}/{barang_id}/{value}', 'PenjualanController@setStatusBarangPenjualan');
Route::get('/penjualan/lihat-barang/{id}', 'PenjualanController@lihatBarang');
Route::get('/penjualan/index/{page}/{load}', 'PenjualanController@indexPage');

Route::resource('stok-barang', StokBarangController::class);
Route::resource('/eoq', EoqController::class);
Route::get('/eoq/get-data-penjualan/{tanggal1}/{tanggal2}', 'EoqController@getData');

Route::get('/history-pembelian', 'HistPembelianController@index');
Route::get('/history-pembelian/get-data/{tgl1}/{tgl2}', 'HistPembelianController@getData');