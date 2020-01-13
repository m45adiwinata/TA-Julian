<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubLokasi extends Model
{
    protected $table = 'sub_lokasi';
    public $timestamps = false;

    public function stok()
    {
        return $this->hasMany('App\StokBarang');
    }
}
