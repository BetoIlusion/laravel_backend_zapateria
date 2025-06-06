<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_solicitud',
        'total',
        'id_usuario'
    ];
    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'total' => 'decimal:2',
        'id_usuario' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
 public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_compra');
    }
    


}
