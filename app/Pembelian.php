<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';

    public function suplier()
    {
        return $this->hasOne('App\Suplier');
    }

    public function status()
    {
        return $this->hasOne('App\Status');
    }
}
