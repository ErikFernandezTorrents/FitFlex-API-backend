<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'usuario']);
        $editorRole = Role::create(['name' => 'editor']);
        $peremiumRole = Role::create(['name' => 'premium']);
        $entrenadorRole = Role::create(['name' => 'entrenador']);

        Permission::create(['name' => 'planes.*']);
        Permission::create(['name' => 'planes.list']);
        Permission::create(['name' => 'planes.create']);
        Permission::create(['name' => 'planes.update']);
        Permission::create(['name' => 'planes.read']);
        Permission::create(['name' => 'planes.delete']);

        Permission::create(['name' => 'suscripciones.*']);
        Permission::create(['name' => 'suscripciones.list']);
        Permission::create(['name' => 'suscripciones.create']);
        Permission::create(['name' => 'suscripciones.update']);
        Permission::create(['name' => 'suscripciones.read']);
        Permission::create(['name' => 'suscripciones.delete']);

        Permission::create(['name' => 'dietas.*']);
        Permission::create(['name' => 'dietas.list']);
        Permission::create(['name' => 'dietas.create']);
        Permission::create(['name' => 'dietas.update']);
        Permission::create(['name' => 'dietas.read']);
        Permission::create(['name' => 'dietas.delete']);

        Permission::create(['name' => 'cursos.*']);
        Permission::create(['name' => 'cursos.list']);
        Permission::create(['name' => 'cursos.create']);
        Permission::create(['name' => 'cursos.update']);
        Permission::create(['name' => 'cursos.read']);
        Permission::create(['name' => 'cursos.delete']);

        Permission::create(['name' => 'usuarios.*']);
        Permission::create(['name' => 'usuarios.list']);
        Permission::create(['name' => 'usuarios.create']);
        Permission::create(['name' => 'usuarios.update']);
        Permission::create(['name' => 'usuarios.read']);
        Permission::create(['name' => 'usuarios.delete']);

        Permission::create(['name' => 'usuario_sesiones.*']);
        Permission::create(['name' => 'usuario_sesiones.list']);
        Permission::create(['name' => 'usuario_sesiones.create']);
        Permission::create(['name' => 'usuario_sesiones.update']);
        Permission::create(['name' => 'usuario_sesiones.read']);
        Permission::create(['name' => 'usuario_sesiones.delete']);

        Permission::create(['name' => 'ejercicios.*']);
        Permission::create(['name' => 'ejercicios.list']);
        Permission::create(['name' => 'ejercicios.create']);
        Permission::create(['name' => 'ejercicios.update']);
        Permission::create(['name' => 'ejercicios.read']);
        Permission::create(['name' => 'ejercicios.delete']);

        Permission::create(['name' => 'ejercicios_sesiones.*']);
        Permission::create(['name' => 'ejercicios_sesiones.list']);
        Permission::create(['name' => 'ejercicios_sesiones.create']);
        Permission::create(['name' => 'ejercicios_sesiones.update']);
        Permission::create(['name' => 'ejercicios_sesiones.read']);
        Permission::create(['name' => 'ejercicios_sesiones.delete']);

        Permission::create(['name' => 'inscripciones.*']);
        Permission::create(['name' => 'inscripciones.list']);
        Permission::create(['name' => 'inscripciones.create']);
        Permission::create(['name' => 'inscripciones.update']);
        Permission::create(['name' => 'inscripciones.read']);
        Permission::create(['name' => 'inscripciones.delete']);

        $adminRole->givePermissionTo([ 'usuarios.*','planes.list','planes.read','suscripciones.list','suscripciones.read','dietas.list','dietas.read','cursos.list','cursos.read','usuario_sesiones.list','usuario_sesiones.read','ejercicios.list','ejercicios.read','ejercicios_sesiones.list','ejercicios_sesiones.read','inscripciones.list','inscripciones.read']);
        $userRole->givePermissionTo([ 'inscripciones.create','cursos.list','cursos.read','suscripciones.create','suscripciones.delete','ejercicios.list','ejercicios.read' ]);
        $editorRole->givePermissionTo([ 'usuarios.list','usuarios.read','planes.*','suscripciones.*','dietas.*','cursos.*','usuario_sesiones.*','ejercicios.*','ejercicios_sesiones.*','inscripciones.*']);
        $peremiumRole->givePermissionTo([ 'inscripciones.create','inscripciones.delete','inscripciones.list','inscripciones.read','cursos.list','cursos.read','suscripciones.create','suscripciones.delete','ejercicios.list','ejercicios.read']);
        $entrenadorRole->givePermissionTo([ 'inscripciones.create','inscripciones.delete','inscripciones.list','inscripciones.read','cursos.list','cursos.read','suscripciones.create','suscripciones.delete','ejercicios.list','ejercicios.read' ]);

        $name  = config('admin.name');
        $admin = User::where('name', $name)->first();
        $admin->assignRole('admin');
    }
}
