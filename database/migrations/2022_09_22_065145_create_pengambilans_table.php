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
        Schema::create('pengambilans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuota_harian_id')->constrained();
            $table->foreignId('truk_id')->constrained();
            $table->foreignId('sopir_id')->constrained();
            $table->foreignId('kernet_id')->constrained();
            $table->integer('jumlah')->default(560);
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
        Schema::dropIfExists('pengambilans');
    }
};
