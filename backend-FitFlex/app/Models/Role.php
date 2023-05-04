<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
    ];

    const USUARIO = 'usuario';
    const ADMIN = 'admin';
    const PREMIUM  = 'premium';
    const ENTRENADOR  = 'entrenador';
    const EDITOR  = 'editor';

    public function usuarios()
    {
        return $this->hasMany(User::class,'id');
    }
}