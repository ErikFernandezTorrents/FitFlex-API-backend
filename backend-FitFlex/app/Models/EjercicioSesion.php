<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjercicioSesion extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'ejercicios_sesiones';
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
