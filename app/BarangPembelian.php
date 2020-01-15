<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangPembelian extends Model
{
    protected $table = 'barang_pembelian';
    protected $fillable = ['pembelian_id', 'barang_id', 'harga_beli'];
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
