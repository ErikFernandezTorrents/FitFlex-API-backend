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
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id("id");
            $table->unsignedBigInteger("cantidad_pagada");
            $table->unsignedBigInteger("periodo_contr");
            $table->unsignedBigInteger('id_plan');
            $table->foreign('id_plan')->references('id')->on('planes')
            ->onDelete('cascade');
            $table->datetime("fecha_ini");
            $table->datetime("fecha_fin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['id_suscripcion']);
            $table->dropColumn('id_suscripcion');
        });
        Schema::dropIfExists('suscripciones');
    }
};
