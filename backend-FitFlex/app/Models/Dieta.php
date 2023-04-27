<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'filepath',
    ];
    
    public function usuarios()
    {
        return $this->hasMany(Usuario::class,'id');
    }
}
