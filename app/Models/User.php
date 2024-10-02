<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];
    // Relación con el modelo de Catalogos
    public function catalogos()
    {
        return $this->hasMany(Catalogos::class, 'id_users');
    }

    // Relación con el modelo de Operaciones
    public function operaciones()
    {
        return $this->hasMany(Operaciones::class, 'id_users');
    }
     // Relación con el modelo de ReportesOperativos (un usuario puede tener varios reportes operativos)
     public function reportesOperativos()
     {
         return $this->hasMany(ReportesOperativos::class, 'id_users');
     }
}
