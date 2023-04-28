<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'sesiones';
    protected $fillable = [
        'id',
        'duracion',
        'fecha',
    ];

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'id');
    }

}
