<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'planes';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'descripcion',
        'cuota',
    ];

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'id');
    }
}
