<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CompraController;

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


    // Aquí puedes agregar más rutas protegidas por Sanctum
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('auth.user');
});

Route::prefix('pruebas')->group(function () {
    Route::get('/hello', function () {
        return response()->json(['message' => 'Hello World!']);
    });

    Route::get('/compras', [CompraController::class, 'index']);
    Route::get('/compras/{id}', [CompraController::class, 'show']);
    Route::post('/compras', [CompraController::class, 'store']);
});