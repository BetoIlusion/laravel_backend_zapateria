<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ClienteController;
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
    //RUTAS DE CLIENTE
    Route::get('/cliente', [ClienteController::class, 'index'])->name('auth.cliente.index');

    //RUTAS DE PRODUCTO
    Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
    Route::post('/producto', [ProductoController::class, 'store'])->name('producto');
    Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('producto.show');
    Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');

    //RUTAS DE COMPRAS/PEDIDO
    Route::get('/compra', [CompraController::class, 'index'])->name('compra.index');
    Route::post('/compra', [CompraController::class, 'store'])->name('compra');

    //RUTAS DE PAGO
    Route::get('/compra/{id}/pago', [PagoController::class, 'index'])->name('pago.index');
    Route::post('/pago', [CompraController::class, 'store'])->name('pago.store');
    Route::get('/pago/{id}', [CompraController::class, 'showPagos'])->name('pago.show');
    Route::put('/pago/{id}', [CompraController::class, 'updatePagos'])->name('pago.update');
    Route::delete('/pago/{id}', [CompraController::class, 'destroyPagos'])->name('pago.destroy');

    // Aquí puedes agregar más rutas protegidas por Sanctum
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('auth.user');

    //RUTAS CLIENTE
    Route::get('/cliente', [ClienteController::class, 'index'])->name('auth.cliente.index');
    Route::post('/cliente', [ClienteController::class, 'store'])->name('auth.cliente');
    Route::get('/cliente/{id}', [ClienteController::class, 'show'])->name('auth.cliente.show');
    Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('auth.cliente.update');
    Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('auth.cliente.destroy');

    //RUTAS DE COMPRAS
    Route::resource('/compra', CompraController::class)->names([
        'index' => 'auth.compra.index',
        'store' => 'auth.compra.store',
        'show' => 'auth.compra.show',
        'update' => 'auth.compra.update',
        'destroy' => 'auth.compra.destroy',
    ]);
    Route::get('/compra/{id}/pago', [CompraController::class, 'showPagos'])->name('compra.showPago');
});
