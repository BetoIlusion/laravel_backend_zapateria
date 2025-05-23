<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'fecha_asignado' => 'required|date',
            'id_usuario' => 'required|exists:users,id',
        ]);

        $asignacion = new Asignacion();
        $asignacion->id_usuario = $validatedData['id_usuario'];
        $asignacion->fecha_asignado = $validatedData['fecha_asignado'];
        $asignacion->save();

        return response()->json([
            'message' => 'Asignacion creada exitosamente',
            'data' => $asignacion
        ], 201);
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
}
