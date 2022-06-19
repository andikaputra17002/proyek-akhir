<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('dokter_id')->nullable();
            $table->foreignId('jam_praktek_id')->nullable();
            $table->enum('shiff', ['pagi', 'malam'])->nullable();
            $table->date('tanggal_pendaftaran')->nullable();
            $table->string('transaksi')->nullable();
            $table->string('antrian')->nullable();
            $table->string('keluhan')->nullable();
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
        Schema::dropIfExists('pendaftarans');
    }
}
