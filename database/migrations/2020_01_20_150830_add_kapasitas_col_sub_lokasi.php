<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKapasitasColSubLokasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_lokasi', function (Blueprint $table) {
            $table->integer('kapasitas')->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_lokasi', function (Blueprint $table) {
            $table->dropColumn('kapasitas');
        });
    }
}
