<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coche;
use Illuminate\Support\Facades\Cookie;

class CocheController extends Controller
{
    public function index(Request $request)
    {
        $concesionario = session('concesionario');

        if ($request->has('filtrar') && $request->filtrar === 'concesionario') {
            $coches = Coche::where('concesionario', $concesionario)->get();
            $filtroActivo = true;
        } else {
            $coches = Coche::all();
            $filtroActivo = false;
        }

        return view('coches.index', compact('coches', 'concesionario', 'filtroActivo'));
    }

    public function create()
    {
        return view('coches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer',
        ]);

        $coche = new Coche();
        $coche->modelo = $request->modelo;
        $coche->unidades = $request->unidades;
        $coche->concesionario = session('concesionario');
        $coche->save();

        return redirect()->route('coches.index');
    }

    public function edit($id)
    {
        $coche = Coche::findOrFail($id);
        return view('coches.edit', compact('coche'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'modelo' => 'required|string|max:30',
            'unidades' => 'required|integer',
        ]);

        $coche = Coche::findOrFail($id);
        $coche->modelo = $request->modelo;
        $coche->unidades = $request->unidades;
        $coche->save();

        return redirect()->route('coches.index');
    }

    public function destroy($id)
    {
        $coche = Coche::findOrFail($id);
        $coche->delete();

        return redirect()->route('coches.index');
    }
}