<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $table = 'permisos'; 

    protected $fillable = [
        'name',
    ];

    public function roles()
{
    return $this->belongsToMany(Roles::class, 'permisos_roles', 'permission_id', 'role_id');
}

}
