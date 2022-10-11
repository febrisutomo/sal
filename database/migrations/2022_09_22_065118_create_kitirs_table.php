<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_sa');
            $table->foreign('no_sa')->references('no_sa')->on('sas');
            $table->date('tanggal');
            $table->integer('kuota');
            $table->integer('sisa_kuota');
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
        Schema::dropIfExists('kitirs');
    }
};
