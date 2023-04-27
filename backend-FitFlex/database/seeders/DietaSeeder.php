<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DietaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dieta=[
            ['id'=> '1','name'=>'Dieta masa muscular', 'descripcion'=>'Dieta para ganar masa muscular','filepath'=>'https://i.pinimg.com/originals/e9/3c/e8/e93ce89455097699def02e8aa789b4a5.png'],
        ];
        DB::table('dietas')->insert($dieta);
    }
}
