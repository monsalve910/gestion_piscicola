<?php

namespace App\Services;

use App\Models\Especie;
use App\Models\Lago;
use App\Models\Reproduccion;
use App\Models\Venta;
use App\Models\User;
use App\Models\Recomendacion;
use App\Models\Monitoreo;
use Illuminate\Support\Collection;

class ReporteService
{
    public function getData(string $tipo, array $filtros = []): Collection
    {
        return match ($tipo) {
            'especies'       => $this->getEspecies($filtros),
            'lagos'          => $this->getLagos($filtros),
            'reproducciones' => $this->getReproducciones($filtros),
            'ventas'         => $this->getVentas($filtros),
            'usuarios'       => $this->getUsuarios($filtros),
            'recomendaciones' => $this->getRecomendaciones($filtros),
            'monitoreos'     => $this->getMonitoreos($filtros),
            default          => collect(),
        };
    }

    public function getResumen(string $tipo, Collection $data): array
    {
        return match ($tipo) {
            'especies' => [
                'Total especies' => $data->count(),
                'Total peces' => $data->sum('cantidad'),
                'Precio promedio' => $data->sum(fn($e) => $e->precio * $e->cantidad) / max($data->sum('cantidad'), 1),
            ],
            'lagos' => [
                'Total lagos' => $data->count(),
                'Capacidad total' => $data->sum('capacidad_maxima_peces'),
                'Lagos activos' => $data->filter(fn($l) => $l->estado === 'activo')->count(),
            ],
            'reproducciones' => [
                'Total eventos' => $data->count(),
                'Crías totales' => $data->sum('cantidad'),
                'Promedio por evento' => round($data->avg('cantidad'), 1),
            ],
            'ventas' => [
                'Total ventas' => $data->count(),
                'Peso total (kg)' => round($data->sum('peso_kg'), 2),
                'Ingreso total' => $data->sum('total'),
            ],
            'usuarios' => [
                'Total usuarios' => $data->count(),
                'Administradores' => $data->filter(fn($u) => $u->rol === 'administrador')->count(),
                'Trabajadores' => $data->filter(fn($u) => $u->rol === 'trabajador')->count(),
            ],
            'recomendaciones' => [
                'Total recomendaciones' => $data->count(),
                'Alto riesgo' => $data->filter(fn($r) => $r->nivel_riesgo === 'alto')->count(),
                'Medio riesgo' => $data->filter(fn($r) => $r->nivel_riesgo === 'medio')->count(),
            ],
            'monitoreos' => [
                'Total monitoreos' => $data->count(),
                'Temp. promedio' => round($data->avg('temperatura_agua'), 1) . ' °C',
                'pH promedio' => round($data->avg('ph'), 2),
            ],
            default => [],
        };
    }

    public function getOpcionesFiltro(string $tipo): array
    {
        return match ($tipo) {
            'especies'       => ['lagos' => Lago::orderBy('nombre')->pluck('nombre', 'id')],
            'lagos'          => ['estados' => ['activo', 'inactivo']],
            'reproducciones' => [
                'especies' => Especie::orderBy('nombre')->pluck('nombre', 'id'),
            ],
            'ventas'         => [
                'especies' => Especie::orderBy('nombre')->pluck('nombre', 'id'),
            ],
            'usuarios'       => [
                'roles' => ['trabajador', 'administrador'],
                'estados' => ['activo', 'inactivo'],
            ],
            'recomendaciones' => [
                'lagos' => Lago::orderBy('nombre')->pluck('nombre', 'id'),
                'tipos' => ['recomendacion', 'alerta'],
                'niveles' => ['bajo', 'medio', 'alto'],
            ],
            'monitoreos'     => [
                'lagos' => Lago::orderBy('nombre')->pluck('nombre', 'id'),
                'estados' => ['bueno', 'regular', 'malo'],
            ],
            default => [],
        };
    }

    private function getEspecies(array $filtros): Collection
    {
        return Especie::with('lago')
            ->when($filtros['lago_id'] ?? null, fn($q, $v) => $q->where('lago_id', $v))
            ->latest()
            ->get();
    }

    private function getLagos(array $filtros): Collection
    {
        return Lago::withCount('especies')
            ->when($filtros['estado'] ?? null, fn($q, $v) => $q->where('estado', $v))
            ->latest()
            ->get();
    }

    private function getReproducciones(array $filtros): Collection
    {
        return Reproduccion::with('especie')
            ->when($filtros['especie_id'] ?? null, fn($q, $v) => $q->where('especie_id', $v))
            ->when($filtros['fecha_desde'] ?? null, fn($q, $v) => $q->whereDate('fecha', '>=', $v))
            ->when($filtros['fecha_hasta'] ?? null, fn($q, $v) => $q->whereDate('fecha', '<=', $v))
            ->latest()
            ->get();
    }

    private function getVentas(array $filtros): Collection
    {
        return Venta::with('especie')
            ->when($filtros['especie_id'] ?? null, fn($q, $v) => $q->where('especie_id', $v))
            ->when($filtros['fecha_desde'] ?? null, fn($q, $v) => $q->whereDate('fecha_venta', '>=', $v))
            ->when($filtros['fecha_hasta'] ?? null, fn($q, $v) => $q->whereDate('fecha_venta', '<=', $v))
            ->latest()
            ->get();
    }

    private function getUsuarios(array $filtros): Collection
    {
        return User::query()
            ->when($filtros['rol'] ?? null, fn($q, $v) => $q->where('rol', $v))
            ->when($filtros['estado'] ?? null, fn($q, $v) => $q->where('status', $v))
            ->latest()
            ->get();
    }

    private function getRecomendaciones(array $filtros): Collection
    {
        return Recomendacion::with('lago')
            ->when($filtros['lago_id'] ?? null, fn($q, $v) => $q->where('lago_id', $v))
            ->when($filtros['tipo'] ?? null, fn($q, $v) => $q->where('tipo', $v))
            ->when($filtros['nivel_riesgo'] ?? null, fn($q, $v) => $q->where('nivel_riesgo', $v))
            ->latest()
            ->get();
    }

    private function getMonitoreos(array $filtros): Collection
    {
        return Monitoreo::with('lago')
            ->when($filtros['lago_id'] ?? null, fn($q, $v) => $q->where('lago_id', $v))
            ->when($filtros['estado_general'] ?? null, fn($q, $v) => $q->where('estado_general', $v))
            ->when($filtros['fecha_desde'] ?? null, fn($q, $v) => $q->whereDate('fecha_monitoreo', '>=', $v))
            ->when($filtros['fecha_hasta'] ?? null, fn($q, $v) => $q->whereDate('fecha_monitoreo', '<=', $v))
            ->latest()
            ->get();
    }
}
