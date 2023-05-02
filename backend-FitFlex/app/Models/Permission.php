<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'permissions';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'id_curso',
    ];
}