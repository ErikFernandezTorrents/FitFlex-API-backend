<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    use HasFactory;

    protected $fillable = [
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
