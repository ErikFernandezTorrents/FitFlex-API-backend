<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EjercicioSesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ejercicioSesion=[
            ['id_ejercicio'=> '1','id_sesiones'=>'1'],
        ];
        DB::table('ejercicios_sesiones')->insert($ejercicioSesion);
    }
}
