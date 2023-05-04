<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'suscripciones';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'cantidad_pagada',
        'fecha_ini',
        'fecha_fin',
        'periodo_contr',
    ];

    public function planes()
    {
        return $this->belongsTo(Plan::class, 'id');
    }
}
