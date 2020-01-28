<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKetersediaanColStokBarangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stok_barangs', function (Blueprint $table) {
            $table->integer('ketersediaan')->default(0)->after('sub_lokasi_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stok_barangs', function (Blueprint $table) {
            $table->dropColumn('ketersediaan');
        });
    }
}
