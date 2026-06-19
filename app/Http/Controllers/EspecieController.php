<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Lago;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EspecieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $especies = Especie::with('lago')
            ->when($search, function ($query, $search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json([
                'tbody' => view('especies._table', compact('especies'))->render(),
                'pagination' => view('especies._pagination', compact('especies', 'search'))->render(),
            ]);
        }

        return view('especies.index', compact('especies', 'search'));
    }

    public function create()
    {
        $lagos = Lago::all();
        return view('especies.create', compact('lagos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad'    => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $lago = Lago::find($request->lago_id);
                    if ($lago && $value > $lago->capacidad_maxima_peces) {
                        $fail("La cantidad no puede superar la capacidad máxima del lago ({$lago->capacidad_maxima_peces} peces).");
                    }
                },
            ],
            'lago_id' => [
                'required',
                'exists:lagos,id',
                Rule::unique('especies', 'lago_id'),
            ],
        ], [
            'lago_id.unique' => 'Este lago ya tiene una especie registrada. Cada lago solo puede tener una especie.',
        ]);

        Especie::create($validated);

        return redirect()->route('especies.index')->with('success', 'Especie creada correctamente.');
    }

    public function show(Especie $especie)
    {
        return view('especies.show', compact('especie'));
    }

    public function edit(Especie $especie)
    {
        $lagos = Lago::all();
        return view('especies.edit', compact('especie', 'lagos'));
    }

    public function update(Request $request, Especie $especie)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad'    => [
                'required',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    $lago = Lago::find($request->lago_id);
                    if ($lago && $value > $lago->capacidad_maxima_peces) {
                        $fail("La cantidad no puede superar la capacidad máxima del lago ({$lago->capacidad_maxima_peces} peces).");
                    }
                },
            ],
            'lago_id' => [
                'required',
                'exists:lagos,id',
                Rule::unique('especies', 'lago_id')->ignore($especie->id),
            ],
        ], [
            'lago_id.unique' => 'Este lago ya tiene una especie registrada. Cada lago solo puede tener una especie.',
        ]);

        $especie->update($validated);

        return redirect()->route('especies.index')->with('success', 'Especie actualizada correctamente.');
    }

    public function destroy(Especie $especie)
    {
        $especie->delete();

        return redirect()->route('especies.index')->with('success', 'Especie eliminada correctamente.');
    }
}