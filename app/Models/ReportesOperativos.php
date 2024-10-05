<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportesOperativos extends Model
{
    use HasFactory;

    protected $table = 'reportes_operativos'; // Nombre de la tabla

    protected $fillable = [
        'id_users',  
        'id_site',  
        'event_type', 
        'date', 
        'pdf_document', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function operacion()
    {
        return $this->belongsTo(Operaciones::class, 'id_site'); 
    }
}
