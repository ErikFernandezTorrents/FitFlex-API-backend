<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EjercicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ejercicio=[
            ['id'=> '1','id_video'=>'1','titulo'=>'Levantamiento de barra','descripcion'=>'Levantamiento de barra'],
        ];
        DB::table('ejercicios')->insert($ejercicio);
    }
}
