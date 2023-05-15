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
    public $timestamps = false;
    protected $fillable = [
        'id_ejercicio',
        'id_sesiones',
    ];

    public function ejercicios()
    {
        return $this->belongsToMany(Ejercicio::class,'id');
    }

    public function sesiones()
    {
        return $this->belongsToMany(Sesion::class,'id');
    }

}
