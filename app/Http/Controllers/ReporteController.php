<?php

namespace App\Http\Controllers;

use App\Services\ReporteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReporteController extends Controller
{
    protected ReporteService $reporteService;

    public function __construct(ReporteService $reporteService)
    {
        $this->reporteService = $reporteService;
    }

    public function index(Request $request)
    {
        $tiposDisponibles = [
            'especies'       => 'Reporte de Especies',
            'lagos'          => 'Reporte de Lagos',
            'reproducciones' => 'Reporte de Reproducciones',
            'ventas'         => 'Reporte de Ventas',
            'usuarios'       => 'Reporte de Usuarios',
            'recomendaciones' => 'Recomendaciones',
            'monitoreos'     => 'Reporte de Monitoreos',
        ];

        $tipo = $request->session()->get('reporte_tipo');
        $filtros = $request->session()->get('reporte_filtros', []);
        $data = collect();
        $resumen = [];

        if ($tipo && isset($tiposDisponibles[$tipo])) {
            $data = $this->reporteService->getData($tipo, $filtros);
            $resumen = $this->reporteService->getResumen($tipo, $data);
        }

        $opcionesFiltro = $tipo ? $this->reporteService->getOpcionesFiltro($tipo) : [];

        return view('reportes.index', compact(
            'tiposDisponibles', 'tipo', 'filtros', 'data', 'resumen', 'opcionesFiltro'
        ));
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'tipo'         => 'required|string|in:especies,lagos,reproducciones,ventas,usuarios,recomendaciones,monitoreos',
            'lago_id'      => 'nullable|exists:lagos,id',
            'especie_id'   => 'nullable|exists:especies,id',
            'estado'       => 'nullable|string',
            'rol'          => 'nullable|string',
            'tipo_recom'   => 'nullable|string',
            'nivel_riesgo' => 'nullable|string',
            'estado_general' => 'nullable|string',
            'fecha_desde'  => 'nullable|date',
            'fecha_hasta'  => 'nullable|date|after_or_equal:fecha_desde',
        ]);

        $tipo = $validated['tipo'];

        $filtros = array_filter([
            'lago_id'       => $validated['lago_id'] ?? null,
            'especie_id'    => $validated['especie_id'] ?? null,
            'estado'        => $validated['estado'] ?? null,
            'rol'           => $validated['rol'] ?? null,
            'tipo'          => $validated['tipo_recom'] ?? null,
            'nivel_riesgo'  => $validated['nivel_riesgo'] ?? null,
            'estado_general' => $validated['estado_general'] ?? null,
            'fecha_desde'   => $validated['fecha_desde'] ?? null,
            'fecha_hasta'   => $validated['fecha_hasta'] ?? null,
        ], fn($v) => !is_null($v) && $v !== '');

        $request->session()->put('reporte_tipo', $tipo);
        $request->session()->put('reporte_filtros', $filtros);

        return redirect()->route('reportes.index');
    }

    public function exportPdf(Request $request, string $tipo)
    {
        $filtros = $request->session()->get('reporte_filtros', []);
        $data = $this->reporteService->getData($tipo, $filtros);
        $resumen = $this->reporteService->getResumen($tipo, $data);
        $usuario = auth()->user();
        $fechaGeneracion = now()->format('d/m/Y H:i:s');

        $pdf = Pdf::loadView("reportes.exports.{$tipo}_pdf", compact(
            'data', 'resumen', 'usuario', 'fechaGeneracion'
        ));

        $nombre = 'reporte_' . $tipo . '_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($nombre);
    }

    public function exportExcel(Request $request, string $tipo)
    {
        $filtros = $request->session()->get('reporte_filtros', []);
        $data = $this->reporteService->getData($tipo, $filtros);

        $exportClass = 'App\\Exports\\' . Str::studly($tipo) . 'Export';
        $export = new $exportClass($data);

        $nombre = 'reporte_' . $tipo . '_' . now()->format('Ymd_His') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download($export, $nombre);
    }
}
