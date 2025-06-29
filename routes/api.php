<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PagoController;
use App\Models\DetalleCompra;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// =============================================
// @USER
// =============================================

Route::prefix('user')->group(function () {
    Route::get('/all', [Controller::class, 'index']);
    Route::post('/', [Controller::class, 'login']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    //actualizar usuario
    Route::put('/{id}', [Controller::class, 'update']);
});

// =============================================
// @RUTAS DE PRODUCTO
// =============================================
// mostrar y mostrar con filtro
Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/filtro/{id}', [ProductoController::class, 'indexFiltro']);
// mostrar uno con todos los detalle
Route::get('/producto/{id}', [ProductoController::class, 'show']);
//el actualizar esta dentro del middleware


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // actualizar datos
    Route::put('/producto/{id}', [ProductoController::class, 'update']);
    // ---------------------------------------
    // @RUTAS USUARIOS/CLIENTES/ADMIN/DISTRIBUIDORES
    // ---------------------------------------
    //CRUD
    Route::resource('/cliente', Controller::class);


    // =============================================
    // @RUTAS DE COMPRA
    // =============================================
    // 1ero crear el registro 'compra' para despues añadir a los registro de detalle_compra sus id_compra
    // ver como colocar el id_pago segun el enunciado del proyecto antes de crearlo
    Route::post('/compra', [CompraController::class, 'store']);
    // insertar Detalle de la compra(id_compra que generas) que es lo que estará registrado en el carrito(frontend)
    Route::post('/compra/detalle', [CompraController::class, 'storeDetalle']);
    // Luego usar este comando para sumar los subtotales en la compra e insertarlo en la compra creada, 
    Route::patch('/compra/{id}/total', [CompraController::class, 'calcularTotal']);
    



    // ---------------------------------------
    // @RUTAS DE DISTRIBUIDORES
    // ---------------------------------------
    //CRUD
    Route::resource('/distribuidor', DistribuidorController::class);
});
