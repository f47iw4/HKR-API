<?php

use App\Http\Controllers\API\ProductoController;
use Illuminate\Support\Facades\Route;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API de HKR",
 *      description="Documentación de la API HKR generada automáticamente con Swagger",
 *      @OA\Contact(
 *          email="fgrhanny@gmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url="http://localhost:8000/api",
 *      description="Servidor Local"
 * )
 */

/**
 * @OA\PathItem(
 *     path="/productos"
 * )
 */
Route::get('/test', function () {
    return response()->json(['message' => 'Hello, API!']);
});

Route::get('/', function () {
    return view('welcome');
});

// Rutas de productos
Route::post('/productos', [ProductoController::class, 'store']);
Route::apiResource('/productos', ProductoController::class);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::put('/productos/{id}', [ProductoController::class, 'update']);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);
