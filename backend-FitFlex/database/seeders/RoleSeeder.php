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
            ['id'=> '1','name'=>'usuario'],
            ['id'=> '2','name'=>'editor'],
            ['id'=> '3','name'=>'admin'],
            ['id'=> '4','name'=>'premium'],
            ['id'=> '5','name'=>'entrenador']
        ];
        DB::table('roles')->insert($roles);
    }
}
