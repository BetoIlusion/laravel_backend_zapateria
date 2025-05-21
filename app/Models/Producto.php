<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'descripcion',
        'id_usuario'
    ];
    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
    ];

}
