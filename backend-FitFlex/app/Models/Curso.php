<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'cursos';

    protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'modalidad',
        'duracion',
        'filepath',
    ];
    public $timestamps = false;
    
    public function sesiones()
    {
        return $this->hasMany(Sesion::class);
    }

    public function inscribed()
    {
        return $this->belongsToMany(User::class, 'inscribed');
    }
    public function inscribes()
    {
        return $this->hasMany(Inscripcion::class);
    }

}
