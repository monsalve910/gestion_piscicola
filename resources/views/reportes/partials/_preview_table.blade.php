@php use Illuminate\Support\Str; @endphp
<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
    <div class="p-4">
        <div class="flex justify-between items-center mb-4">
            <div>
                <span class="text-sm text-gray-600">Total de registros: <strong>{{ $data->count() }}</strong></span>
                <span class="text-sm text-gray-400 mx-2">|</span>
                <span class="text-sm text-gray-600">Generado: <strong>{{ now()->format('d/m/Y H:i') }}</strong></span>
            </div>
            @if ($data->isNotEmpty())
            <div class="flex gap-2">
                <a href="{{ route('reportes.export-pdf', $tipo) }}"
                   class="btn-sm btn-danger flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    PDF
                </a>
                <a href="{{ route('reportes.export-excel', $tipo) }}"
                   class="btn-sm btn-primary flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Excel
                </a>
            </div>
            @endif
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        @if ($tipo === 'especies')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Descripción</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Cantidad</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Precio</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Lago</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Registro</th>
                        @elseif ($tipo === 'lagos')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Ubicación</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tamaño (m²)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Profundidad (m)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Capacidad</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Especies</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Registro</th>
                        @elseif ($tipo === 'reproducciones')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Especie</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Cantidad</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Observaciones</th>
                        @elseif ($tipo === 'ventas')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Especie</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Peso (kg)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Precio por kg</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        @elseif ($tipo === 'usuarios')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nombre</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Rol</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Teléfono</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Registro</th>
                        @elseif ($tipo === 'recomendaciones')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Lago</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Mensaje</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipo</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Nivel Riesgo</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                        @elseif ($tipo === 'monitoreos')
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Lago</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Temperatura (°C)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">pH</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Oxígeno (mg/L)</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($data as $row)
                        <tr class="hover:bg-gray-50 transition-colors">
                            @if ($tipo === 'especies')
                                <td class="px-4 py-3">{{ $row->nombre }}</td>
                                <td class="px-4 py-3">{{ Str::limit($row->descripcion, 40) ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $row->cantidad }}</td>
                                <td class="px-4 py-3">${{ number_format($row->precio, 2) }}</td>
                                <td class="px-4 py-3">{{ $row->lago->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $row->created_at->format('d/m/Y') }}</td>
                            @elseif ($tipo === 'lagos')
                                <td class="px-4 py-3">{{ $row->nombre }}</td>
                                <td class="px-4 py-3">{{ $row->ubicacion ?? '-' }}</td>
                                <td class="px-4 py-3">{{ number_format($row->tamano, 2) }}</td>
                                <td class="px-4 py-3">{{ number_format($row->profundidad, 2) }}</td>
                                <td class="px-4 py-3">{{ $row->capacidad_maxima_peces }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->estado) }}</td>
                                <td class="px-4 py-3">{{ $row->especies_count ?? $row->especies->count() }}</td>
                                <td class="px-4 py-3">{{ $row->created_at->format('d/m/Y') }}</td>
                            @elseif ($tipo === 'reproducciones')
                                <td class="px-4 py-3">{{ $row->especie->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $row->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $row->cantidad }}</td>
                                <td class="px-4 py-3">{{ Str::limit($row->observaciones, 40) ?? '-' }}</td>
                            @elseif ($tipo === 'ventas')
                                <td class="px-4 py-3">{{ $row->fecha_venta->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $row->especie->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ number_format($row->peso_kg, 2) }}</td>
                                <td class="px-4 py-3">${{ number_format($row->precio_unitario, 2) }}</td>
                                <td class="px-4 py-3">${{ number_format($row->total, 2) }}</td>
                            @elseif ($tipo === 'usuarios')
                                <td class="px-4 py-3">{{ $row->name }}</td>
                                <td class="px-4 py-3">{{ $row->email }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->rol) }}</td>
                                <td class="px-4 py-3">{{ $row->telefono ?? '-' }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->status) }}</td>
                                <td class="px-4 py-3">{{ $row->created_at->format('d/m/Y') }}</td>
                            @elseif ($tipo === 'recomendaciones')
                                <td class="px-4 py-3">{{ $row->lago->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ Str::limit($row->mensaje, 50) }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->tipo) }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->nivel_riesgo) }}</td>
                                <td class="px-4 py-3">{{ $row->created_at->format('d/m/Y') }}</td>
                            @elseif ($tipo === 'monitoreos')
                                <td class="px-4 py-3">{{ $row->lago->nombre ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $row->fecha_monitoreo->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ number_format($row->temperatura_agua, 2) }}</td>
                                <td class="px-4 py-3">{{ number_format($row->ph, 2) }}</td>
                                <td class="px-4 py-3">{{ number_format($row->nivel_oxigeno, 2) }}</td>
                                <td class="px-4 py-3">{{ ucfirst($row->estado_general) }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-6 text-center text-gray-500">
                                No se encontraron registros con los filtros aplicados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
