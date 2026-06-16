<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLagoRequest;
use App\Http\Requests\UpdateLagoRequest;
use App\Models\Lago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LagoController extends Controller
{
    public function index(Request $request): View|\Illuminate\Http\JsonResponse
    {
        $search = $request->get('search');
        $lagos = Lago::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('ubicacion', 'like', "%{$search}%")
                  ->orWhere('estado', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate(10);

        if ($request->wantsJson()) {
            return response()->json([
                'tbody' => view('lagos._table', compact('lagos', 'search'))->render(),
                'pagination' => $lagos->appends(['search' => $search])->links()->render(),
            ]);
        }

        return view('lagos.index', compact('lagos', 'search'));
    }

    public function create(): View
    {
        return view('lagos.create');
    }

    public function store(StoreLagoRequest $request): RedirectResponse
    {
        Lago::create($request->validated());

        return redirect()->route('lagos.index')
            ->with('success', 'Lago creado correctamente.');
    }

    public function show(Lago $lago): View
    {
        return view('lagos.show', compact('lago'));
    }

    public function edit(Lago $lago): View
    {
        return view('lagos.edit', compact('lago'));
    }

    public function update(UpdateLagoRequest $request, Lago $lago): RedirectResponse
    {
        $lago->update($request->validated());

        return redirect()->route('lagos.index')
            ->with('success', 'Lago actualizado correctamente.');
    }

    public function toggleStatus(Lago $lago): RedirectResponse
    {
        $lago->estado = $lago->esActivo() ? 'inactivo' : 'activo';
        $lago->save();

        $mensaje = $lago->esActivo()
            ? 'Lago activado correctamente.'
            : 'Lago desactivado correctamente.';

        return redirect()->route('lagos.index')
            ->with('success', $mensaje);
    }
}
