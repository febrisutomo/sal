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
        Schema::create('sas', function (Blueprint $table) {
            $table->id();
            $table->string('no_sa');
            $table->foreignId('kitir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sppbe_id')->constrained();
            $table->enum('tipe', ['reguler', 'tambahan']);
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
        Schema::dropIfExists('sas');
    }
};
