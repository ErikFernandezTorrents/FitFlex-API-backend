<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UsuarioSesion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UsuarioSesionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = auth()->user()->id;

        $usuarioSesion = DB::table('usuario_sesiones')
            ->join('sesiones', 'sesiones.id', '=', 'usuario_sesiones.id_sesiones')
            ->where('usuario_sesiones.id_usuario', '=', $uid)
            ->select('sesiones.*')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $usuarioSesion
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($sid)
    {

        // Desar dades a BD
        $usuarioSesion = UsuarioSesion::create([
            'id_usuario' => auth()->user()->id,
            'id_sesiones' => $sid

        ]);
        $usuarioSesion->save();
        
        if ($usuarioSesion){
            return response()->json([
                'success' => true,
                'data'    => $usuarioSesion
            ], 201);
        }else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading usuarioSesion'
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function unsSesion($id)
    {
        $usuarioSesion = UsuarioSesion::where([
            ['id_usuario',  '=' ,auth()->user()->id],
            ['id_sesiones',  '=' ,$id]
        ])->first();

        if ($usuarioSesion) {
            $usuarioSesion->delete();
            return response()->json([
                'success' => true,
                'data'    => $usuarioSesion
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Inscription not exists"
            ], 404); 
        }
    }
}
