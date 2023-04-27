<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $fillable = [
        'duracion',
        'fecha',
    ];

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'id');
    }

}
