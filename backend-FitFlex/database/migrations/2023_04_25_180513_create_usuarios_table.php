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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id("id");
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('id_role')->nullable();
            $table->foreign('id_role')->references('id')->on('roles');
            $table->unsignedBigInteger('id_suscripcion')->nullable();
            $table->foreign('id_suscripcion')->references('id')->on('suscripciones');
            $table->unsignedBigInteger('id_dieta')->nullable();
            $table->foreign('id_dieta')->references('id')->on('dietas');
            $table->unsignedBigInteger('id_curso')->nullable();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
};
