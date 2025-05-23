<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    protected $fillable = [
        'marca',
        'modelo',
        'anio',
        'color',
        'precio',
        'id_distribuidor'
    ];
    protected $casts = [
        'marca' => 'string',
        'modelo' => 'string',
        'anio' => 'integer',
        'color' => 'string',
        'precio' => 'decimal:2',
        'id_distribuidor' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function distribuidor()
     {
          return $this->belongsTo(Distribuidor::class, 'id_distribuidor');
     }
}
