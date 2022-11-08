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
        Schema::create('penyalurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengambilan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pangkalan_id')->constrained()->cascadeOnDelete();
            $table->integer('kuantitas');
            $table->integer('harga');
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
        Schema::dropIfExists('penyalurans');
    }
};
