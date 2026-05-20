<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function index()
    {
        $especies = Especie::all();

        return view('especies.index', compact('especies'));
    }

    public function create()
    {
        return view('especies.create');
    }

    public function store(Request $request)
    {
        Especie::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'lago_id' => $request->lago_id,
        ]);

        return redirect()->route('especies.index')
            ->with('success', 'Especie registrada correctamente');
    }

    public function edit($id)
    {
        $especie = Especie::findOrFail($id);

        return view('especies.edit', compact('especie'));
    }

    public function update(Request $request, $id)
    {
        $especie = Especie::findOrFail($id);

        $especie->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'lago_id' => $request->lago_id,
        ]);

        return redirect()->route('especies.index')
            ->with('success', 'Especie actualizada');
    }

    public function destroy($id)
    {
        $especie = Especie::findOrFail($id);

        $especie->delete();

        return redirect()->route('especies.index')
            ->with('success', 'Especie eliminada');
    }
}