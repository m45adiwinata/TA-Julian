<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('lokasi', LokasiController::class);
    $router->resource('sub-lokasi', SubLokasiController::class);
    $router->resource('status', StatusController::class);
    $router->resource('satuan', SatuanController::class);
    $router->resource('suplier', SuplierController::class);
    $router->resource('pelanggan', PelangganController::class);
    $router->resource('barang', BarangController::class);
});
