<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    public function satuan()
    {
        return $this->hasOne('App\Satuan');
    }

    public function stok()
    {
        return $this->hasMany('App\StokBarang');
    }

    public function child()
    {
        return $this->hasOne('App\Barang', 'parent_id');
    }
}
