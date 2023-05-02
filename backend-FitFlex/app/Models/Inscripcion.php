<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'inscripciones';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'id_curso',
    ];

}