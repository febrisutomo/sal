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
        Schema::create('truks', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('plat_nomor')->unique();
            $table->string('merk');
            $table->integer('kapasitas');
            $table->foreignId('sopir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kernet_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('truks');
    }
};
