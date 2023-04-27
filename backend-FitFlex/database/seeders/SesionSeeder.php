<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SesionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fecha_ini = Carbon::now();

        $sesion=[
            ['id'=> '1','fecha'=>$fecha_ini,'duracion'=>1, 'id_curso'=>'1'],
        ];
        DB::table('sesiones')->insert($sesion);
    }
}
