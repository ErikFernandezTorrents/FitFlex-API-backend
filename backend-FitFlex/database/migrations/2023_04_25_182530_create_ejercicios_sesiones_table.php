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
        Schema::create('ejercicios_sesiones', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ejercicio');
            $table->foreign('id_ejercicio')->references('id')->on('ejercicios')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_sesiones');
            $table->foreign('id_sesiones')->references('id')->on('sesiones')
            ->onDelete('cascade');
        });
        Schema::table('ejercicios_sesiones', function (Blueprint $table) {
            $table->id()->first();
            $table->unique(['id_ejercicio', 'id_sesiones']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ejercicios_sesiones');
    }
};
