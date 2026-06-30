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
        $lagos = Lago::whereDoesntHave('especie')->get();
        return view('especies.create', compact('lagos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
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
            'temp_min'     => 'required|numeric|min:20|max:50',
            'temp_max'     => 'required|numeric|min:20|max:50|gt:temp_min',
            'oxigeno_min'  => 'required|numeric|min:0|max:30',
            'oxigeno_max'  => 'required|numeric|min:0|max:30|gt:oxigeno_min',
        ], [
            'lago_id.unique' => 'Este lago ya tiene una especie registrada. Cada lago solo puede tener una especie.',
            'temp_min.required' => 'La temperatura mínima es obligatoria.',
            'temp_min.min' => 'La temperatura mínima debe ser mayor o igual a 20 °C.',
            'temp_max.required' => 'La temperatura máxima es obligatoria.',
            'temp_max.gt' => 'La temperatura máxima debe ser mayor a la temperatura mínima.',
            'oxigeno_min.required' => 'El oxígeno mínimo es obligatorio.',
            'oxigeno_max.required' => 'El oxígeno máximo es obligatorio.',
            'oxigeno_max.gt' => 'El oxígeno máximo debe ser mayor al oxígeno mínimo.',
        ]);

        $validated['ph_min'] = 6.5;
        $validated['ph_max'] = 8.5;

        Especie::create($validated);

        return redirect()->route('especies.index')->with('success', 'Especie creada correctamente.');
    }

    public function show(Especie $especie)
    {
        return view('especies.show', compact('especie'));
    }

    public function edit(Especie $especie)
    {
        $lagos = Lago::whereDoesntHave('especie')
            ->orWhereHas('especie', fn($q) => $q->where('id', $especie->id))
            ->get();
        return view('especies.edit', compact('especie', 'lagos'));
    }

    public function update(Request $request, Especie $especie)
    {
        $validated = $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
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
            'temp_min'     => 'required|numeric|min:20|max:50',
            'temp_max'     => 'required|numeric|min:20|max:50|gt:temp_min',
            'oxigeno_min'  => 'required|numeric|min:0|max:30',
            'oxigeno_max'  => 'required|numeric|min:0|max:30|gt:oxigeno_min',
        ], [
            'lago_id.unique' => 'Este lago ya tiene una especie registrada. Cada lago solo puede tener una especie.',
            'temp_min.required' => 'La temperatura mínima es obligatoria.',
            'temp_min.min' => 'La temperatura mínima debe ser mayor o igual a 20 °C.',
            'temp_max.required' => 'La temperatura máxima es obligatoria.',
            'temp_max.gt' => 'La temperatura máxima debe ser mayor a la temperatura mínima.',
            'oxigeno_min.required' => 'El oxígeno mínimo es obligatorio.',
            'oxigeno_max.required' => 'El oxígeno máximo es obligatorio.',
            'oxigeno_max.gt' => 'El oxígeno máximo debe ser mayor al oxígeno mínimo.',
        ]);

        $validated['ph_min'] = 6.5;
        $validated['ph_max'] = 8.5;

        $especie->update($validated);

        return redirect()->route('especies.index')->with('success', 'Especie actualizada correctamente.');
    }

    public function destroy(Especie $especie)
    {
        $especie->delete();

        return redirect()->route('especies.index')->with('success', 'Especie eliminada correctamente.');
    }
}