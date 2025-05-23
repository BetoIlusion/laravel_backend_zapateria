<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
    }

    public function show($id)
    {
        $compra = Compra::with('pago')->find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        return response()->json($compra);
    }
    public function store(Request $request)
    {
       
        $compra = new Compra();
        $compra->fecha_solicitud = $request->fecha_solicitud;
        $compra->total = $request->total;
        $compra->id_usuario = $request->id_usuario;
        $compra->save();

        return response()->json(['message' => 'Compra created successfully', 'compra' => $compra], 201);
    }
    public function update(Request $request, $id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        $compra->cantidad = $request->cantidad;
        $compra->destino = $request->destino;
        $compra->estadoEntrega = $request->estadoEntrega;
        $compra->save();
        return response()->json(['message' => 'Compra updated successfully', 'compra' => $compra]);
    }
    public function destroy($id)
    {
        $compra = Compra::find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        $compra->delete();
        return response()->json(['message' => 'Compra deleted successfully']);
    }
    public function showPagos($id)
    {
        $compra = Compra::with('pago')->find($id);
        if (!$compra) {
            return response()->json(['message' => 'Compra not found'], 404);
        }
        return response()->json($compra->pago);
    }
}
