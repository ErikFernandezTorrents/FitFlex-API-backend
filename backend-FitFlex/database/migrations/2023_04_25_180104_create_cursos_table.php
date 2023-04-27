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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id("id");
            $table->string("titulo");
            $table->string("descripcion");
            $table->string("modalidad");
            $table->unsignedBigInteger("duracion");
            $table->string("filepath");
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
            $table->dropForeign(['id_curso']);
            $table->dropColumn('id_curso');
        });
        Schema::dropIfExists('cursos');
    }
};
