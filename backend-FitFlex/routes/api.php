<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DietasController;
use App\Http\Controllers\Api\CursosController;
use App\Http\Controllers\Api\PlansController;
use App\Http\Controllers\Api\SuscripcionesController;
use App\Http\Controllers\Api\SesionesController;
use App\Http\Controllers\Api\UsuarioSesionesController;
use App\Http\Controllers\Api\EjerciciosController;
use App\Http\Controllers\Api\EjerciciosSesionsController;
use App\Http\Controllers\Api\InscripcionesController;
use App\Http\Controllers\Api\TokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('dietas', DietasController::class);
    //->middleware('auth:sanctum'); Descomentar cuando tengas todo comprobado
Route::apiResource('cursos', CursosController::class);
    //->middleware('auth:sanctum'); Descomentar cuando tengas todo comprobado
Route::apiResource('planes', PlansController::class);

Route::apiResource('suscripciones', SuscripcionesController::class);
Route::apiResource('sesiones', SesionesController::class);
Route::apiResource('usuariosesiones', UsuarioSesionesController::class);
Route::apiResource('ejercicios', EjerciciosController::class);
Route::apiResource('ejerciciossesiones', EjerciciosSesionsController::class);
Route::apiResource('inscripciones', InscripcionesController::class);

Route::get('/user', [TokenController::class, 'user'])
    ->middleware('auth:sanctum');
Route::post('/register', [TokenController::class, 'register'])
    ->middleware('guest');
Route::post('/login', [TokenController::class, 'login'])
    ->middleware('guest');
Route::post('/logout', [TokenController::class, 'logout'])
    ->middleware('auth:sanctum');