<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suscripcion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;


class SuscripcionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $id = auth()->user()->id;
        $user = User::where('id',$id)->first();

        $user->removeRole(Role::USUARIO);
        $user->assignRole(Role::PREMIUM);
        
        $user->tokens()->delete();
        $user->save();
        
        $fechaIni = Carbon::now();
        $fechaFin = $fechaIni->copy()->addYear();

        $suscripcion = Suscripcion::create([
            "cantidad_pagada"      => "100",
            "fecha_ini"     => $fechaIni,
            "fecha_fin"  => $fechaFin,
            "periodo_contr" => "1",
            "id_plan" => "1",
        ]);

        $usuarioModificado = User::where('id', $id)
        ->update(['id_suscripcion' => $suscripcion->id]);

        return response()->json([
            'success' => true,
            'data'    => $usuarioModificado
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suscripcion = Suscripcion::find($id);
        if ($suscripcion == null){
            return response()->json([
                'success'  => false,
                'message' => 'Error notFound suscripcion'
            ], 404);

        }

        if ($suscripcion) {
            return response()->json([
                'success' => true,
                'data'    => $suscripcion
            ], 200);
        }else {
            return response()->json([
                'success'  => false,
                'message' => 'Error no encontramos el suscripcion a leer'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
