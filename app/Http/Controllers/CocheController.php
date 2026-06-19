<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;

class CocheController extends Controller
{
    /**
     * Leer los concesionarios del archivo .txt
     */
    private function getConcesionarios()
    {
        $path = storage_path('app/concesionarios.txt');
        if (file_exists($path)) {
            // Lee el archivo omitiendo líneas vacías y saltos de línea
            return file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        return [];
    }

    public function index()
    {
        // Obtener todos los coches ordenados por concesionario y modelo
        $coches = Coche::orderBy('concesionario')->orderBy('modelo')->get();
        return view('coches.index', compact('coches'));
    }

    public function create()
    {
        $concesionarios = $this->getConcesionarios();
        return view('coches.create', compact('concesionarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer|min:0',
            'concesionario' => 'required|string|max:50',
        ]);

        Coche::create($request->all());

        return redirect()->route('coches.index')->with('success', 'Coche registrado correctamente.');
    }

    public function edit(Coche $coche)
    {
        $concesionarios = $this->getConcesionarios();
        return view('coches.edit', compact('coche', 'concesionarios'));
    }

    public function update(Request $request, Coche $coche)
    {
        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer|min:0',
            'concesionario' => 'required|string|max:50',
        ]);

        $coche->update($request->all());

        return redirect()->route('coches.index')->with('success', 'Coche actualizado correctamente.');
    }

    public function destroy(Coche $coche)
    {
        $coche->delete();

        return redirect()->route('coches.index')->with('success', 'Coche eliminado correctamente.');
    }
}