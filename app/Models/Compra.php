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
        'id_cliente'
    ];
    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'total' => 'decimal:2',
        'id_cliente' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_compra');
    }
    


}
