<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportesOperativos extends Model
{
    use HasFactory;

    protected $table = 'reportes_operativos'; // Nombre de la tabla

    protected $fillable = [
        'user_id',  // ID del usuario que creó el reporte
        'site_id',  // ID del sitio asociado
        'event_type', // Tipo de evento
        'date', // Fecha del evento
        'pdf_document', // Ruta del documento PDF
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function operacion()
    {
        return $this->belongsTo(Operaciones::class, 'site_id'); 
    }
}
