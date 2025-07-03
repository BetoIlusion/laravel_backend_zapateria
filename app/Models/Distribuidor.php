<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    use HasFactory;
    protected $fillable = [
        'estado_disponibilidad',
        'id_usuario'
    ];
    protected $casts = [
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
