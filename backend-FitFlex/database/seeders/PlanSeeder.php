<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan=[
            ['id'=> '1','name'=>'Premium', 'descripcion'=>'Al suscribirte a este plan, accederas a todas las funcionalidades que ofrece fitflex,incluiendo la opcion de realizar todos los cursos disponibles en cualquier momento.','cuota'=>100],
        ];
        DB::table('planes')->insert($plan);
    }
}
