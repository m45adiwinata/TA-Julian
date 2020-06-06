<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangTerpecah extends Model
{
    protected $fillable = ['penjualan_id', 'barang_id', 'jml_terpecah'];
    public $timestamps = false;

    public function penjualan()
    {
        return $this->belongsTo('App\Penjualan');
    }
    
    public function barang()
    {
    	return $this->belongsTo('App\Barang');
    }
}
