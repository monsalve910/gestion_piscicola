<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonitoreoRequest;
use App\Http\Requests\UpdateMonitoreoRequest;
use App\Models\Lago;
use App\Models\Monitoreo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoreoController extends Controller
{
    public function seleccionarLago(): View
    {
        $lagos = Lago::with('especie')->orderBy('nombre')->get();
        return view('monitoreos.seleccionar', compact('lagos'));
    }

    public function index(Request $request, Lago $lago): View|\Illuminate\Http\JsonResponse
    {
        $lago->load('especie');
        $search = $request->get('search');
        $monitoreos = $lago->monitoreos()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('estado_general', 'like', "%{$search}%")
                      ->orWhere('observaciones', 'like', "%{$search}%");
                });
            })
            ->orderBy('fecha_monitoreo', 'desc')->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json([
                'tbody' => view('monitoreos._table', compact('monitoreos', 'lago', 'search'))->render(),
                'pagination' => $monitoreos->appends(['search' => $search])->links()->render(),
            ]);
        }

        return view('monitoreos.index', compact('monitoreos', 'lago', 'search'));
    }

    public function create(Lago $lago): View
    {
        return view('monitoreos.create', compact('lago'));
    }

    public function store(StoreMonitoreoRequest $request, Lago $lago): RedirectResponse
    {
        $lago->monitoreos()->create($request->validated());

        return redirect()->route('monitoreos.index', $lago)
            ->with('success', 'Monitoreo registrado correctamente.');
    }

    public function show(Lago $lago, Monitoreo $monitoreo): View
    {
        return view('monitoreos.show', compact('lago', 'monitoreo'));
    }

    public function edit(Lago $lago, Monitoreo $monitoreo): View
    {
        return view('monitoreos.edit', compact('lago', 'monitoreo'));
    }

    public function update(UpdateMonitoreoRequest $request, Lago $lago, Monitoreo $monitoreo): RedirectResponse
    {
        $monitoreo->update($request->validated());

        return redirect()->route('monitoreos.index', $lago)
            ->with('success', 'Monitoreo actualizado correctamente.');
    }

    public function destroy(Lago $lago, Monitoreo $monitoreo): RedirectResponse
    {
        $monitoreo->delete();

        return redirect()->route('monitoreos.index', $lago)
            ->with('success', 'Monitoreo eliminado correctamente.');
    }
}
