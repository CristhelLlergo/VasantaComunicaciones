<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finanzas extends Model
{
    use HasFactory;

    protected $table = 'finanzas'; 

    protected $fillable = [
        'id_site',
        'date',
        'movement',
        'movement_type',
        'amount',
        'date_of_movement',
        'expiration_date',
        'status',
    ];

    // Relación con Operaciones
    public function operaciones()
    {
        return $this->belongsTo(Operaciones::class, 'id_site', 'id'); 
    }
    
    
    
}
