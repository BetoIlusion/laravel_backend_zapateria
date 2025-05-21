<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $productos = Producto::where('id_usuario', $user->id)->get();
        return response()->json($productos);
    }

    public function show($id)
    {
        $user = auth()->user();
        $producto = Producto::where('id_usuario', $user->id)->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        $producto = Producto::create([
            'nombre' => $validatedData['nombre'],
            'descripcion' => $validatedData['descripcion'],
            'precio' => $validatedData['precio'],
            'stock' => $validatedData['stock'],
            'id_usuario' => auth()->id(),
        ]);

        return response()->json($producto, 201);
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $producto = Producto::where('id_usuario', $user->id)->find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();

        $producto->update([
            'nombre' => $validatedData['nombre'],
            'descripcion' => $validatedData['descripcion'],
            'precio' => $validatedData['precio'],
            'stock' => $validatedData['stock'],
        ]);

        return response()->json($producto, 200);
    }

    public function destroy($id)
    {
        // Aquí puedes implementar la lógica para eliminar un producto
    }
}
