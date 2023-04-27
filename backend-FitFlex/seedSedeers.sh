#!/bin/bash

php artisan db:seed --class=PlanSeeder
php artisan db:seed --class=SuscripcionSeeder
php artisan db:seed --class=DietaSeeder
php artisan db:seed --class=CursoSeeder
php artisan db:seed --class=SesionSeeder
php artisan db:seed --class=UsuarioSeeder
php artisan db:seed --class=UsuarioSesionSeeder
php artisan db:seed --class=EjercicioSeeder
php artisan db:seed --class=EjercicioSesionSeeder
php artisan db:seed --class=InscripcionSeeder