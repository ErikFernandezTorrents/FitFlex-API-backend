<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjercicioSesion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ejercicio',
        'id_sesiones',
    ];

    public function ejercicios()
    {
        return $this->belongsTo(Ejercicio::class,'id');
    }

    public function sesiones()
    {
        return $this->belongsTo(Sesion::class,'id');
    }

}
