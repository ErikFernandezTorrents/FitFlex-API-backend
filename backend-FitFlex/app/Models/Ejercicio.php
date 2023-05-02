<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'ejercicios';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'id_video',
    ];

    public function ejerciciosSesiones()
    {
        return $this->hasMany(EjercicioSesion::class,'id');
    }
}
