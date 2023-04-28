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
    protected $fillable = [
        'id',
        'name',
    ];

    public function usuarios()
    {
        return $this->hasMany(User::class,'id');
    }
}