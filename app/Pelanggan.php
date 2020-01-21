<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    public function penjualan()
    {
    	return $this->hasMany('App\Penjualan');
    }
}
