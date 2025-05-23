<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_vehiculo',
        'estado_disponibilidad',
        'id_usuario'
    ];
    protected $casts = [
        'tipo_vehiculo' => 'string',
        'estado_disponibilidad' => 'string',
        'id_usuario' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function vehiculo()
    {
        return $this->hasOne(Vehiculo::class, 'id_distribuidor');
    }

}
