<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'modalidad',
        'duracion',
        'filepath',
    ];

    public function sesiones()
    {
        return $this->hasMany(Sesion::class);
    }

    public function inscribed()
    {
        return $this->belongsToMany(User::class, 'inscribed');
    }

}
