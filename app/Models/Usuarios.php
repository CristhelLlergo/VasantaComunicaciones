<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    

    protected $table = 'nuevos_usuarios'; 

    protected $fillable = [
        
            'name', 
            'email', 
            'password' 
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
