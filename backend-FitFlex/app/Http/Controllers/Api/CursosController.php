<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\PaginateCollection;
use App\Http\Resources\CursoResource;
use App\Models\Inscripcion;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('show','inscribe','uninscribe');
    }
    public function index(Request $request)
    {
        $query = null;

        // Filters
        if ($titulo = $request->get('titulo')) {
            $query = Curso::where('titulo', 'like', "%{$titulo}%");
        }
        
        if ($modalidad = $request->get('modalidad')) {
            $query = $query 
                ? $query->where('modalidad', 'like', "%{$modalidad}%")
                : Curso::where('modalidad', 'like', "%{$modalidad}%");
        }

        // Pagination
        $paginate = $request->get('paginate', 0);
        $data = $query 
            ? ($paginate ? $query->paginate() : $query->get()) // si no funciona quita $paginate ? $query->paginate() y $paginate ? Curso::paginate()
            : ($paginate ? Curso::paginate() : Curso::all());

        return response()->json([
            'success' => true,
            'data'    => new PaginateCollection($data, CursoResource::class)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        if ($curso == null){
            return response()->json([
                'success'  => false,
                'message' => 'Error notFound curso'
            ], 404);

        }

        if ($curso) {
            return response()->json([
                'success' => true,
                'data'    => $curso
            ], 200);
        }else {
            return response()->json([
                'success'  => false,
                'message' => 'Error no encontramos el curso a leer'
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
    /**
     * Add favorite
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inscribe($id) 
    {
        $id_usuario = auth()->user()->id;
        $inscripcion = Inscripcion::where('id_usuario', $id_usuario)->first();
        $user = auth()->user();
        Log::debug($id_usuario);
        Log::debug($inscripcion);
        $userRoles = $user->roles->pluck('name')->toArray();
        $isUsuario = $user->hasRole('usuario');

        
        Log::debug('Antes de entrar en el if');
        if ($isUsuario && $inscripcion) {
            Log::debug('Entro en el if');
            return response()->json([
                'success' => false,
                'message' => 'Ya estás inscrito en un curso'
            ], 200);
        }else{

            try {
                $inscribe = Inscripcion::create([
                    'id_usuario'  => auth()->user()->id,
                    'id_curso' => $id
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => "Inscripcion already exists"
                ], 500); 
            }
            
            return response()->json([
                'success' => true,
                'data'    => $inscribe
            ], 200);
        }
    }

    public function uninscribe($id)
    {
        $inscribe = Inscripcion::where([
            ['id_usuario',  '=' ,auth()->user()->id],
            ['id_curso',  '=' ,$id]
        ])->first();

        if ($inscribe) {
            $inscribe->delete();
            return response()->json([
                'success' => true,
                'data'    => $inscribe
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Inscription not exists"
            ], 404); 
        }
    }
}
