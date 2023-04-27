<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            ['id'=> '1','nombre'=>'usuario'],
            ['id'=> '2','nombre'=>'editor'],
            ['id'=> '3','nombre'=>'admin'],
            ['id'=> '4','nombre'=>'premium'],
            ['id'=> '5','nombre'=>'entrenador']
        ];
        DB::table('roles')->insert($roles);
    }
}
