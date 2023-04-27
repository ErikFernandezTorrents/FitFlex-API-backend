<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curso=[
            ['id'=> '1','titulo'=>'CrossFit con FitFlex', 'modalidad'=>'CrossFit','descripcion'=>'esto es una prueba','duracion'=>2,'filepath'=>'https://phantom-marca.unidadeditorial.es/de052f5e16cc7ad78960e50136dd9535/resize/1320/f/jpg/assets/multimedia/imagenes/2021/09/08/16310868187831.jpg'],
        ];
        DB::table('cursos')->insert($curso);
    }
}
