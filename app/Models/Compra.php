<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = [
        'cantidad',
        'destino',
        'estadoEntrega',
        'pago_id'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public static function create(array $compraData)
    {
        $compra = new Compra();
        $compra->cantidad = $compraData['cantidad'];
        $compra->destino = $compraData['destino'];
        $compra->estadoEntrega = $compraData['estadoEntrega'];
    
        $compra->save();
        return $compra;
    }
    public static function updateCompra($id, array $compraData)
    {
        $compra = Compra::find($id);
        if ($compra) {
            $compra->cantidad = $compraData['cantidad'];
            $compra->destino = $compraData['destino'];
            $compra->estadoEntrega = $compraData['estadoEntrega'];
            $compra->save();
            return $compra;
        }
        return null;
    }
    public static function deleteCompra($id)
    {
        $compra = Compra::find($id);
        if ($compra) {
            $compra->delete();
            return true;
        }
        return false;
    }
    public static function getAllCompras()
    {
        return Compra::all();
    }
    public static function getCompraById($id)
    {
        return Compra::find($id);
    }

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'pago_id');
    }

}
