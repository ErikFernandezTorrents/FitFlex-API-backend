<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'dietas';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'descripcion',
        'filepath',
    ];
    
    public function usuarios()
    {
        return $this->hasMany(User::class,'id');
    }
}
