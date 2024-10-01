<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operaciones extends Model
{
    protected $table = 'operaciones'; 
    protected $fillable = [
        'site_name',
        'registration_timestamp',
        'event_type',
        'action',
        'id_users',  
        'position',
        'opening_date',
        'closing_date',
        'event_status',
    ];
    

    
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'id_users'); 
    }

   
}
