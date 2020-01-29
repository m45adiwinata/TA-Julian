<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    protected $fillable = ['barang_id', 'lokasi_id', 'sub_lokasi_id'];
    
    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }

    public function subLokasi()
    {
    	return $this->belongsTo('App\SubLokasi');
    }
}
