<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('penjualan_id');
            $table->integer('barang_id');
            $table->double('harga_jual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_penjualans');
    }
}
