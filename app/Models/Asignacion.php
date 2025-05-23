<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_asignado',
        'id_usuario',
    ];

    protected $casts = [
        'fecha_asignado' => 'datetime',
        'id_usuario' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
}
