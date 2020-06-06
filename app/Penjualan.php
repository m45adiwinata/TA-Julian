<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    public function barang()
    {
    	return $this->belongsToMany('App\Barang', 'barang_penjualan');
    }

    public function barangPenjualan()
    {
    	return $this->hasMany('App\BarangPenjualan');
    }

    public function pelanggan()
    {
    	return $this->belongsTo('App\Pelanggan');
    }

    public function sales()
    {
    	return $this->belongsTo('App\Sales');
    }

    public function barangTerpecah()
    {
        return $this->hasMany('App\BarangTerpecah');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($penjualan) {
             $penjualan->barangPenjualan()->delete();
             $penjualan->barangTerpecah()->delete();
        });
    }
}
