<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTerpecahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_terpecahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('penjualan_id');
            $table->integer('barang_id');
            $table->integer('jml_terpecah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_terpecahs');
    }
}
