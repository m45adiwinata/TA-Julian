<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    public function suplier()
    {
        return $this->belongsTo('App\Suplier');
    }

    public function status()
    {
        return $this->hasOne('App\Status');
    }

    public function barang()
    {
        return $this->belongsToMany('App\Barang');
    }

    public function barangPembelian()
    {
        return $this->hasMany('App\BarangPembelian');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($pembelian) {
             $pembelian->barangPembelian()->delete();
        });
    }
}
