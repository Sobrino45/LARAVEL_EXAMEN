<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'concesionario' => 'required|string'
        ]);

        $path = storage_path('app/concesionarios.txt');
        $concesionarios = file_exists($path) ? file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

        // Comprobación de acceso leyendo el fichero
        if (in_array($request->concesionario, $concesionarios)) {
            session(['concesionario' => $request->concesionario]);
            
            // Guardamos dato de última sesión en la cookie (válida por 120 minutos)
            $fecha = now()->format('d/m/Y H:i:s');
            Cookie::queue('ultima_sesion', $fecha, 120);

            return redirect()->route('coches.index');
        }

        return back()->withErrors(['concesionario' => 'El concesionario no está registrado en el fichero.']);
    }

    public function logout()
    {
        session()->forget('concesionario');
        return redirect()->route('login');
    }
}