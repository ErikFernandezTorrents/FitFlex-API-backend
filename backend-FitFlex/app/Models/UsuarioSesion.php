<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioSesion extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'usuario_sesiones';
    protected $fillable = [
        'id_sesiones',
        'id_usuario',
    ];

    public function ejercicios()
    {
        return $this->belongsTo(Ejercicio::class,'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Sesion::class,'id');
    }

}
