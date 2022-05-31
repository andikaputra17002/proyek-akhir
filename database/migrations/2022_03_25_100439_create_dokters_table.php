<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_dokter');
            $table->string('photo_dokter');
            $table->string('bidang_dokter')->nullable();
            $table->string('hari_praktek')->nullable();
            $table->string('jam_praktek_pagi')->nullable();
            $table->string('jam_praktek_malam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokters');
    }
}
