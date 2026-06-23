<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Reproduccion;
use Illuminate\Http\Request;

class ReproduccionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $reproducciones = Reproduccion::with('especie')
            ->when($search, function ($query, $search) {
                $query->where('observaciones', 'like', "%{$search}%")
                    ->orWhereHas('especie', function ($q) use ($search) {
                        $q->where('nombre', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json([
                'tbody' => view('reproducciones._table', compact('reproducciones'))->render(),
                'pagination' => view('reproducciones._pagination', compact('reproducciones', 'search'))->render(),
            ]);
        }

        return view('reproducciones.index', compact('reproducciones', 'search'));
    }

    public function create()
    {
        $especies = Especie::all();
        return view('reproducciones.create', compact('especies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'especie_id'    => 'required|exists:especies,id',
            'fecha'         => 'required|date',
            'cantidad'      => 'required|integer|min:1',
            'observaciones' => 'nullable|string',
        ]);

        $especie = Especie::findOrFail($request->especie_id);

        if ($request->cantidad > $especie->cantidad) {
            return back()
                ->withInput()
                ->withErrors([
                    'cantidad' => 'La cantidad a reproducir no puede ser mayor que la cantidad disponible de la especie (' . $especie->cantidad . ').'
                ]);
        }

        Reproduccion::create($validated);

        return redirect()
            ->route('reproducciones.index')
            ->with('success', 'Reproducción registrada correctamente.');
    }

    public function show(Reproduccion $reproduccion)
    {
        return view('reproducciones.show', compact('reproduccion'));
    }

    public function edit(Reproduccion $reproduccion)
    {
        $especies = Especie::all();
        return view('reproducciones.edit', compact('reproduccion', 'especies'));
    }

    public function update(Request $request, Reproduccion $reproduccion)
    {
        $validated = $request->validate([
            'especie_id'    => 'required|exists:especies,id',
            'fecha'         => 'required|date',
            'cantidad'      => 'required|integer|min:1',
            'observaciones' => 'nullable|string',
        ]);

        $especie = Especie::findOrFail($request->especie_id);

        if ($request->cantidad > $especie->cantidad) {
            return back()
                ->withInput()
                ->withErrors([
                    'cantidad' => 'La cantidad a reproducir no puede ser mayor que la cantidad disponible de la especie (' . $especie->cantidad . ').'
                ]);
        }

        $reproduccion->update($validated);

        return redirect()
            ->route('reproducciones.index')
            ->with('success', 'Reproducción actualizada correctamente.');
    }

    public function destroy(Reproduccion $reproduccion)
    {
        $reproduccion->delete();

        return redirect()->route('reproducciones.index')->with('success', 'Reproducción eliminada correctamente.');
    }
}