<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangPenjualan extends Model
{
    public $timestamps = false;
    protected $table = 'barang_penjualan';
    protected $fillable = ['penjualan_id', 'barang_id', 'harga_jual'];
}
