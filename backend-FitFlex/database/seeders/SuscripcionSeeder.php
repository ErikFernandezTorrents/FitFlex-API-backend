<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $fecha_ini = Carbon::now();
        $fecha_fin = Carbon::createFromFormat('Y-m-d H:i:s', '2024-04-27 19:03:40');

        $suscripcion=[
            ['id'=> '1','fecha_ini'=>$fecha_ini, 'fecha_fin'=>$fecha_fin,'cantidad_pagada'=>100,'periodo_contr'=>1,'id_plan'=>'1'],
        ];
        DB::table('suscripciones')->insert($suscripcion);
    }
}
