<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogos extends Model
{
    use HasFactory;

    protected $table = 'catalogos'; 

    protected $fillable = [
        'catalog_name', 
        'id_users',     
        'pdf_document', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
