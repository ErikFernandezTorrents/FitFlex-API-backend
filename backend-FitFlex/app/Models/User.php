<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasRoles;
    use CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table="users";
    public $guard_name = 'web';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'id_suscripcion',
        'id_dieta',
        'id_curso',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class, 'id');
    }

    public function dietas()
    {
        return $this->hasMany(Dieta::class, 'id');
    }

    public function inscribes()
    {
        return $this->belongsToMany(Curso::class, 'inscribes');
    }
    public function doSesions()
    {
        return $this->belongsToMany(Sesion::class, 'doSesion');
    }
}
