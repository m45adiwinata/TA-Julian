<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    public $timestamps = false;

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }
}
