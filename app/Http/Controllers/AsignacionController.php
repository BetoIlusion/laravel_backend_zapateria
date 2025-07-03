<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\AsignacionDistribuidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Compra;
use App\Models\Distribuidor;
use App\Models\Vehiculo;


class AsignacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return response()->json(['message' => 'Asignaciones', 'user' => $user]);
    }


    public function create()
    {
        //
    }


    public function insertar(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'id_compra' => ['required', 'exists:compras,id'],
            'id_distribuidor' => ['required', 'exists:distribuidores,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $idCompra = $request->input('id_compra');
        $idDistribuidor = $request->input('id_distribuidor');

        $compra = Compra::find($idCompra);
        $distribuidor = Distribuidor::where('id', $idDistribuidor)
            ->where('estado_disponibilidad', 'desocupado')
            ->first();

        if (!$compra || !$distribuidor) {
            return response()->json([
                'status' => 'false',
                'message' => 'Distribuidor desocupado o compra no disponible'
            ], 200);
        }

        // Obtener vehículo por id_usuario (relación con Distribuidor)
        $vehiculo = Vehiculo::where('id_distribuidor', $distribuidor->id)->first();

        if (!$vehiculo) {
            return response()->json([
                'status' => 'false',
                'message' => 'Vehículo no encontrado para el distribuidor.'
            ], 200);
        }

        $volumenCompra = $compra->volumen_total;
        $capacidadVehiculo = $vehiculo->capacidad_carga;

        $resultado = $volumenCompra <= $capacidadVehiculo;

        return response()->json([
            'status' => $resultado
        ]);
    }

    public function show($id)
    {
        $asignacion = Asignacion::find($id);

        if (!$asignacion) {
            return response()->json(['message' => 'Asignacion no encontrada'], 404);
        }

        return response()->json(['data' => $asignacion], 200);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::find($id);

        if (!$asignacion) {
            return response()->json(['message' => 'Asignacion no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'fecha_asignado' => 'sometimes|required|date',
            'id_usuario' => 'sometimes|required|exists:users,id',
        ]);

        if (isset($validatedData['id_usuario'])) {
            $asignacion->id_usuario = $validatedData['id_usuario'];
        }
        if (isset($validatedData['fecha_asignado'])) {
            $asignacion->fecha_asignado = $validatedData['fecha_asignado'];
        }

        $asignacion->save();

        return response()->json([
            'message' => 'Asignacion actualizada exitosamente',
            'data' => $asignacion
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
    public function insertarObservacion(){
        
    }
}
