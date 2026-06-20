<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckSession;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protegemos las rutas del CRUD usando la clase Middleware
Route::middleware([CheckSession::class])->group(function () {
    Route::resource('coches', CocheController::class)->except(['show']);
});