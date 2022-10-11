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
            $table->foreignId('kitir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('armada_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sopir_id')->constrained()->cascadeOnDelete();
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
