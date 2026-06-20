<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index(Request $request)
    {
        $concesionario = session('concesionario');
        
        // Filtrar modelos del concesionario que ha iniciado sesión
        $coches = Coche::where('concesionario', $concesionario)
                       ->orderBy('modelo')
                       ->get();
                       
        // Obtener la cookie
        $ultimaSesion = $request->cookie('ultima_sesion');

        return view('coches.index', compact('coches', 'concesionario', 'ultimaSesion'));
    }

    public function create()
    {
        return view('coches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer|min:1',
        ]);

        $concesionario = session('concesionario');

        // Alta actualizando unidades si existe
        $cocheExistente = Coche::where('modelo', $request->modelo)
                               ->where('concesionario', $concesionario)
                               ->first();

        if ($cocheExistente) {
            $cocheExistente->unidades += $request->unidades;
            $cocheExistente->save();
            return redirect()->route('coches.index')->with('success', 'El modelo ya existía. Unidades actualizadas correctamente.');
        }

        Coche::create([
            'modelo' => $request->modelo,
            'unidades' => $request->unidades,
            'concesionario' => $concesionario,
        ]);

        return redirect()->route('coches.index')->with('success', 'Nuevo modelo registrado correctamente.');
    }

    public function edit(Coche $coche)
    {
        if ($coche->concesionario !== session('concesionario')) {
            abort(403, 'Acceso no autorizado.');
        }
        return view('coches.edit', compact('coche'));
    }

    public function update(Request $request, Coche $coche)
    {
        if ($coche->concesionario !== session('concesionario')) {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer|min:0',
        ]);

        $coche->update([
            'modelo' => $request->modelo,
            'unidades' => $request->unidades
        ]);

        return redirect()->route('coches.index')->with('success', 'Coche actualizado correctamente.');
    }

    public function destroy(Coche $coche)
    {
        if ($coche->concesionario === session('concesionario')) {
            $coche->delete();
        }

        return redirect()->route('coches.index')->with('success', 'Coche eliminado correctamente.');
    }
}