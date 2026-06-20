<?php

use Illuminate\Support\Facades\Route;
use App\Models\Coche;
use Illuminate\Http\Request;

// Servicio: obtener el listado de modelos de un concesionario
Route::get('/coches/{concesionario}', function ($concesionario) {
    $coches = Coche::where('concesionario', $concesionario)->get();
    return response()->json($coches);
});

// Servicio: insertar un nuevo modelo en un concesionario
Route::post('/coches', function (Request $request) {
    $request->validate([
        'modelo' => 'required|string|max:30',
        'unidades' => 'required|integer|min:1',
        'concesionario' => 'required|string|max:50',
    ]);

    $coche = Coche::create($request->all());
    
    return response()->json([
        'mensaje' => 'Coche insertado mediante servicio',
        'coche' => $coche
    ], 201);
});