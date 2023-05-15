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
    public $timestamps = false;
    protected $fillable = [
        'id',
        'duracion',
        'fecha',
        'id_curso'
    ];

    public function cursos()
    {
        return $this->belongsTo(Curso::class, 'id');
    }
    public function doSesioned()
    {
        return $this->belongsTo(User::class);
    }

}
