<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PagoController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // ---------------------------------------
    // @RUTAS USUARIOS/CLIENTES/ADMIN/DISTRIBUIDORES
    // ---------------------------------------
    //CRUD
    Route::resource('/cliente', Controller::class);

    // ---------------------------------------
    // @RUTAS DE PRODUCTO
    // ---------------------------------------
    //CRUD
    Route::resource('/producto', ProductoController::class);
    //
    Route::get('/producto/existe/{id}', [ProductoController::class, 'existe'])->name('producto.existe');

    // ---------------------------------------
    // @RUTAS DE COMPRAS
    // ---------------------------------------
    //CRUD
    Route::resource('/compra', CompraController::class);


    // ---------------------------------------
    // @RUTAS DE PAGOS 
    // ---------------------------------------
    Route::prefix('compra')->group(function () {
        //CRUD
        Route::get('{id}/pagos', [PagoController::class, 'index'])->name('pagos.index');
        Route::post('{id}/pagos', [PagoController::class, 'store'])->name('pagos.store');
        Route::get('{id}/pagos/{pago}', [PagoController::class, 'show'])->name('pagos.show');
        Route::put('{id}/pagos/{pago}', [PagoController::class, 'update'])->name('pagos.update');
        Route::delete('{id}/pagos/{pago}', [PagoController::class, 'destroy'])->name('pagos.destroy');
    });
    // ---------------------------------------
    // @RUTAS DE DISTRIBUIDORES
    // ---------------------------------------
    //CRUD
    Route::resource('/distribuidor', DistribuidorController::class);
    
});
