<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLokasiSubLokasiColBarangPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_pembelian', function (Blueprint $table) {
            $table->integer('lokasi_id')->after('harga_beli');
            $table->integer('sub_lokasi_id')->after('lokasi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_pembelian', function (Blueprint $table) {
            $table->dropColumn('lokasi_id');
            $table->dropColumn('sub_lokasi_id');
        });
    }
}
