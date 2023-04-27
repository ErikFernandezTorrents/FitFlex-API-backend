<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'id_video',
    ];

    public function ejerciciosSesiones()
    {
        return $this->hasMany(EjercicioSesion::class,'id');
    }
}
