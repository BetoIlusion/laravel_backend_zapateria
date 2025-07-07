<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class Asignacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_asignada',
        'id_compra',
        'id_distribuidor'
    ];

    protected $casts = [
        'fecha_asignado' => 'datetime',
        'id_compra' => 'integer',
        'id_distribuidor' => 'integer',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Distribuidor::class, 'id_distribuidor');
    }

    public function asignarDistribuidor()
    {
        $distribuidorCercano = $this->obtenerDistribuidorMasCercano();
        return $distribuidorCercano;

        return $this;
    }

    public function obtenerDistribuidorMasCercano()
    {
        $menorDistancia = INF;
        $distribuidorCercano = null;

        $compra = Compra::find($this->id_compra);
        $ubicacionCliente = Ubicacion::where('id_usuario', $compra->id_usuario);
        $lat = $ubicacionCliente->latitud;
        $long = $ubicacionCliente->longitud;
        $distribuidores = new Distribuidor();
        $distribuidores = $distribuidores->getDistribuidores();

        foreach ($distribuidores as $distribuidor) {
            $volumenVehiculo = $distribuidor->volumenVehiculo();
            if ($compra->compra_total <= $volumenVehiculo) {
                $ubicacionDistribuidor = Ubicacion::where('id_usuario', $distribuidor->id_usuario);

                $url = "http://router.project-osrm.org/route/v1/driving/{$long},{$lat};{$ubicacionDistribuidor->longitud},{$ubicacionDistribuidor->latitud}?overview=false";
                $response = Http::get($url);

                if ($response->successful()) {
                    $datos = $response->json();
                    $distancia = $datos['routes'][0]['distance'] ?? INF;

                    if ($distancia < $menorDistancia) {
                        $menorDistancia = $distancia;
                        $distribuidorCercano = $distribuidor;
                    }
                }
            }
        }

        return $distribuidorCercano;
    }
}
