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
use App\Http\Controllers\Api\StripePaymentController;
use App\Http\Middleware\CorsMiddleware;


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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::apiResource('dietas', DietasController::class)->middleware('auth:sanctum');
Route::get('/dietas/{dieta}', [DietasController::class, 'download'])
    ->middleware('auth:sanctum');
Route::apiResource('cursos', CursosController::class)->middleware('auth:sanctum');
Route::post('/cursos/{curso}/inscribe', [CursosController::class, 'inscribe'])->name('cursos.inscribe');
Route::delete('/cursos/{curso}/inscribe', [CursosController::class, 'uninscribe'])->name('cursos.uninscribe');

Route::post('/cursos/{curso}', [CursosController::class, 'show'])->name('cursos.show');

Route::apiResource('cursos.sesiones', SesionesController::class)
    ->middleware(['auth:sanctum']);

Route::post('usuarioSesiones/{sesionId}', [UsuarioSesionesController::class,'store'])->middleware('auth:sanctum');
Route::get('usuarioSesiones/', [UsuarioSesionesController::class, 'index'])->middleware('auth:sanctum');

Route::apiResource('planes', PlansController::class);

Route::post('suscribete', [SuscripcionesController::class,'store'])->middleware('auth:sanctum');

Route::apiResource('ejercicios', EjerciciosController::class)->middleware('auth:sanctum');
Route::apiResource('ejerciciossesiones', EjerciciosSesionsController::class)->middleware('auth:sanctum');
Route::get('sesiones/{sesionId}/ejercicios', [EjerciciosSesionsController::class, 'index'])->middleware('auth:sanctum');

Route::get('misCursos/', [InscripcionesController::class, 'index'])->middleware('auth:sanctum');


Route::post('/suscripcion', [StripePaymentController::class, 'stripePost'])->middleware('cors','auth:sanctum');

Route::post('/register', [TokenController::class, 'register']);
Route::post('/login', [TokenController::class, 'login']);

Route::get('/user', [TokenController::class, 'user'])
    ->middleware('auth:sanctum');

Route::post('/user', [TokenController::class,'updateUser'])
    ->middleware('auth:sanctum');

Route::post('/logout', [TokenController::class, 'logout'])
    ->middleware('auth:sanctum');