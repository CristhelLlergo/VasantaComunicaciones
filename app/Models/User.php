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
   
    public function catalogos()
    {
        return $this->hasMany(Catalogos::class, 'id_users');
    }

    
    public function operaciones()
    {
        return $this->hasMany(Operaciones::class, 'id_users');
    }
     
     public function reportesOperativos()
     {
         return $this->hasMany(ReportesOperativos::class, 'id_users');
     }
     public function roles()
     {
         return $this->belongsToMany(Roles::class, 'roles_user', 'user_id', 'role_id');
     }
    
     public function assignRole(string $roleName)
     {
         $role = Roles::where('name', $roleName)->first();
         if ($role && !$this->roles()->where('role_id', $role->id)->exists()) {
             $this->roles()->attach($role);
         }
     }
     
     public function hasPermissions(string $permission): bool
     {
         foreach ($this->roles as $role) {
             if ($role->permissions->contains('name', $permission)) {
                 return true;
             }
         }
         return false;
     }
     
    
}

