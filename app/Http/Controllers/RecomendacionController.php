<?php

namespace App\Http\Controllers;

use App\Models\Lago;
use App\Models\Recomendacion;
use App\Services\RecomendacionEngine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecomendacionController extends Controller
{
    public function __construct(
        private RecomendacionEngine $engine
    ) {}

    public function index(Request $request): View|\Illuminate\Http\JsonResponse
    {
        $search = $request->get('search');
        $lagos = Lago::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('ubicacion', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate(10);

        $datos = [];
        foreach ($lagos as $lago) {
            $datos[$lago->id] = $this->engine->analizarLago($lago);
        }

        if ($request->wantsJson()) {
            $html = '';
            foreach ($lagos as $lago) {
                $html .= view('recomendaciones._card', [
                    'lago' => $lago,
                    'resultado' => $datos[$lago->id],
                ])->render();
            }
            return response()->json([
                'cards' => $html,
                'pagination' => $lagos->appends(['search' => $search])->links()->render(),
            ]);
        }

        return view('recomendaciones.index', compact('lagos', 'datos', 'search'));
    }

    public function show(Lago $lago): View
    {
        $resultado = $this->engine->analizarLago($lago);
        $historial = $lago->recomendaciones()
            ->where('es_actual', false)
            ->latest()
            ->take(20)
            ->get();

        return view('recomendaciones.show', compact('lago', 'resultado', 'historial'));
    }

    public function generate(): RedirectResponse
    {
        $total = $this->engine->generarTodosLosLagos();

        $mensaje = $total > 0
            ? "Recomendaciones generadas correctamente para todos los lagos activos."
            : "No se encontraron lagos con monitoreos para generar recomendaciones.";

        return redirect()->route('recomendaciones.index')
            ->with('success', $mensaje);
    }

    public function generateLake(Lago $lago): RedirectResponse
    {
        $this->engine->generarParaLago($lago);

        return redirect()->route('recomendaciones.show', $lago)
            ->with('success', 'Recomendaciones actualizadas para el lago ' . $lago->nombre . '.');
    }
}
