<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribuidor;

class DistribuidorController extends Controller
{
    public function index(){
        $user = auth()->user();
        $distribuidores = Distribuidor::where('id_usuario', $user->id)->get();
        return response()->json($distribuidores);
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'tipo_vehiculo' => 'required|string',
            'estado_disponibilidad' => 'required|string',
            'id_usuario' => 'required|exists:users,id',
        ]);

        try {
            $distribuidor = Distribuidor::create($validatedData);
            return response()->json($distribuidor, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create distribuidor', 'error' => $e->getMessage()], 500);
        }
    }
    public function show($id) {
        $user = auth()->user();
        $distribuidor = Distribuidor::where('id_usuario', $user->id)->find($id);

        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor not found'], 404);
        }

        return response()->json($distribuidor);
    }
    public function update(Request $request, $id) {
        $user = auth()->user();
        $distribuidor = Distribuidor::where('id_usuario', $user->id)->find($id);

        if (!$distribuidor) {
            return response()->json(['message' => 'Distribuidor not found'], 404);
        }

        $validatedData = $request->validate([
            'tipo_vehiculo' => 'string',
            'estado_disponibilidad' => 'string',
            'id_usuario' => 'exists:users,id',
        ]);

        try {
            $distribuidor->update($validatedData);
            return response()->json($distribuidor);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update distribuidor', 'error' => $e->getMessage()], 500);
        }
    }
}
