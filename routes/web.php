<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;

// Al entrar al sistema, ir directamente al listado de vehículos dentro
Route::get('/', function () {
    return redirect()->route('vehiculos.index');
});

// Ruta para ver el histórico de vehículos que ya salieron
Route::get('vehiculos/historial', [VehiculoController::class, 'historial'])
    ->name('vehiculos.historial');

// Rutas CRUD del recurso Vehiculo
Route::resource('vehiculos', VehiculoController::class);
