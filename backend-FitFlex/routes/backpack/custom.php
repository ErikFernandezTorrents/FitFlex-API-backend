<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    Route::crud('plan', 'PlanCrudController');
    Route::crud('suscripcion', 'SuscripcionCrudController');
    Route::crud('dieta', 'DietaCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('curso', 'CursoCrudController');
    Route::crud('sesion', 'SesionCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('usuario-sesion', 'UsuarioSesionCrudController');
    Route::crud('ejercicio', 'EjercicioCrudController');
    Route::crud('ejercicio-sesion', 'EjercicioSesionCrudController');
    Route::crud('inscripcion', 'InscripcionCrudController');
}); // this should be the absolute last line of this file