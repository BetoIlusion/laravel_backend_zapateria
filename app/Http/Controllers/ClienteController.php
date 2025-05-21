<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Persona;

class ClienteController extends Controller
{
   
    public function index()
    {
        $clientes = Cliente::with('persona')->get();
        return response()->json([
            'clientes' => $clientes,
        ]);
    }
    public function store(Request $request)
    {
      $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
        ]);

        $persona = new Persona();
        $persona->nombre = $request->input('nombre');
        $persona->telefono = $request->input('telefono');
        $persona->save();
        $cliente = new Cliente();
        $cliente->id_persona = $persona->id;
        $cliente->save();
        return response()->json(['message' => 'Cliente creado con éxito'], 201);
    }
    public function show($id)
    {
        $cliente = Cliente::with('persona')->find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json([
            'cliente' => $cliente,
        ]);
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $persona = Persona::find($cliente->id_persona);
        if (!$persona) {
            return response()->json(['message' => 'Persona no encontrada'], 404);
        }
        $persona->nombre = $request->input('nombre');
        $persona->telefono = $request->input('telefono');
        $persona->save();
        return response()->json(['message' => 'Cliente actualizado con éxito']);
    }
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        $persona = Persona::find($cliente->id_persona);
        if ($persona) {
            $persona->delete();
        }
        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado con éxito']);
    }
}
