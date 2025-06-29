<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'id_usuario',
        'id_metodo_pago'
    ];
    protected $casts = [
        'total' => 'decimal:2',
        'id_usuario' => 'integer',
        'id_metodo_pago' => 'integer'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_compra');
    }
    public function compra()
    {
        return $this->belongsTo(MetodoPago::class, 'id_metodo_pago');
    }
}
