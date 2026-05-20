<?php

namespace App\Http\Controllers;

use App\Models\Reproduccion;
use App\Models\Especie;
use Illuminate\Http\Request;

class ReproduccionController extends Controller
{
    public function index()
    {
        $reproducciones = Reproduccion::with('especie')->get();

        return view('reproducciones.index',
            compact('reproducciones'));
    }

    public function create()
    {
        $especies = Especie::all();

        return view('reproducciones.create',
            compact('especies'));
    }

    public function store(Request $request)
    {
        Reproduccion::create([

            'especie_id' => $request->especie_id,

            'fecha' => $request->fecha,

            'cantidad' => $request->cantidad,

            'observaciones' => $request->observaciones,

        ]);

        return redirect()->route('reproducciones.index')
            ->with('success', 'Reproducción registrada');
    }

    public function edit($id)
    {
        $reproduccion = Reproduccion::findOrFail($id);

        $especies = Especie::all();

        return view('reproducciones.edit',
            compact('reproduccion', 'especies'));
    }

    public function update(Request $request, $id)
    {
        $reproduccion = Reproduccion::findOrFail($id);

        $reproduccion->update([

            'especie_id' => $request->especie_id,

            'fecha' => $request->fecha,

            'cantidad' => $request->cantidad,

            'observaciones' => $request->observaciones,

        ]);

        return redirect()->route('reproducciones.index')
            ->with('success', 'Reproducción actualizada');
    }

    public function destroy($id)
    {
        $reproduccion = Reproduccion::findOrFail($id);

        $reproduccion->delete();

        return redirect()->route('reproducciones.index')
            ->with('success', 'Reproducción eliminada');
    }
}