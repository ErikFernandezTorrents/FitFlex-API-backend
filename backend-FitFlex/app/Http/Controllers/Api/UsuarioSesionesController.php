<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json([
            'success' => true,
            'data'    => UsuarioSesion::all()
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // NO. Agafar ID logged userx

        $id_sesion = $request->get('id_sesiones');

        // Desar dades a BD
        $usuarioSesion = UsuarioSesion::create([
            'id_usuario' => auth()->user()->id,
            'id_sesiones' => $id_sesiones

        ]);

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
    public function destroy($id)
    {
        //
    }
}
