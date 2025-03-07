<?php

use Illuminate\Support\Facades\Route;
use Swagger\Swagger; 

// Ruta para servir la documentación Swagger en formato JSON
Route::get('/api/documentation-json', function () {
    return response()->json(Swagger::get());
});


// Ruta para acceder a la vista de Swagger UI
Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.swagger-ui');
});
Route::get('/api/docs', function () {
    return response()->json(Swagger::get());
});

// 
Route::get('/', function () {
    return view('welcome');
});
