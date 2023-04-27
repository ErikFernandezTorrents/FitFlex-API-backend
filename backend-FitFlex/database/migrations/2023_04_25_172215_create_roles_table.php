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
        Schema::create('roles', function (Blueprint $table) {
            $table->id("id")->autoincrementable();
            $table->string('nombre')->unique();
        });

        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true
         ]);         

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['id_role']);
            $table->dropColumn('id_role');
        });
        Schema::dropIfExists('roles');
    }
};
