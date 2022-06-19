<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJamPrakteksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam_prakteks', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('hari_praktek_id')->nullable();
            $table->string('jam_praktek')->nullable();
            $table->string('shift')->nullable();
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
        Schema::dropIfExists('jam_prakteks');
    }
}
