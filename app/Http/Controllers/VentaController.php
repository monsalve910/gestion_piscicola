<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $ventas = Venta::with('especie')
            ->when($search, function ($query, $search) {
                $query->whereHas('especie', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json([
                'tbody' => view('ventas._table', compact('ventas'))->render(),
                'pagination' => view('ventas._pagination', compact('ventas', 'search'))->render(),
            ]);
        }

        return view('ventas.index', compact('ventas', 'search'));
    }

    public function create()
    {
        $especies = Especie::all();
        return view('ventas.create', compact('especies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'especie_id'     => 'required|exists:especies,id',
            'peso_kg'        => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0',
            'fecha_venta'    => 'required|date',
        ]);

        $validated['total'] = $validated['peso_kg'] * $validated['precio_unitario'];

        Venta::create($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta)
    {
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $especies = Especie::all();
        return view('ventas.edit', compact('venta', 'especies'));
    }

    public function update(Request $request, Venta $venta)
    {
        $validated = $request->validate([
            'especie_id'     => 'required|exists:especies,id',
            'peso_kg'        => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0',
            'fecha_venta'    => 'required|date',
        ]);

        $validated['total'] = $validated['peso_kg'] * $validated['precio_unitario'];

        $venta->update($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
