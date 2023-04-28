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
        Schema::create('usuario_sesiones', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('id_sesiones');
            $table->foreign('id_sesiones')->references('id')->on('sesiones')
            ->onDelete('cascade');
        });
        Schema::table('usuario_sesiones', function (Blueprint $table) {
            $table->id()->first();
            $table->unique(['id_usuario', 'id_sesiones']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_sesiones');
    }
};
