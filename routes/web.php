<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protegemos las rutas del CRUD exigiendo que exista la sesión
Route::middleware(function ($request, $next) {
    if (!session()->has('concesionario')) {
        return redirect()->route('login')->withErrors('Debes iniciar sesión con un concesionario válido.');
    }
    return $next($request);
})->group(function () {
    Route::resource('coches', CocheController::class)->except(['show']);
});