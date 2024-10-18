<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciones extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_site',
        'id_users',
        'date',
        'event_type',
        'opening_date',
        'event_status',
        'observations',
    ];

    
    public function operacion()
    {
        return $this->belongsTo(Operaciones::class, 'id_site');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    
}
