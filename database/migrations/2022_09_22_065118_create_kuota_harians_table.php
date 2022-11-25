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
        Schema::create('kuota_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sa_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('kuota_harians');
    }
};
