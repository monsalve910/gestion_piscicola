@php
    $nivel = $resultado['nivel_riesgo'];
    $clases = match ($nivel) {
        'Alto Riesgo' => ['bg' => 'bg-red-50 border-red-200', 'text' => 'text-red-700', 'badge' => 'bg-red-100 text-red-700'],
        'Requiere Atención' => ['bg' => 'bg-amber-50 border-amber-200', 'text' => 'text-amber-700', 'badge' => 'bg-amber-100 text-amber-700'],
        'Saludable' => ['bg' => 'bg-green-50 border-green-200', 'text' => 'text-green-700', 'badge' => 'bg-green-100 text-green-700'],
        default => ['bg' => 'bg-gray-50 border-gray-200', 'text' => 'text-gray-500', 'badge' => 'bg-gray-100 text-gray-500'],
    };
    $badgeClase = match ($nivel) {
        'Alto Riesgo' => 'badge-danger',
        'Requiere Atención' => 'badge-warning',
        'Saludable' => 'badge-success',
        default => 'badge-gray',
    };
@endphp

<div class="border-l-4 {{ $clases['bg'] }} {{ str_replace('bg-', 'border-', $clases['badge']) }} rounded-xl shadow-sm border border-gray-200 p-4">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-2">
                <h3 class="text-lg font-semibold text-gray-900">{{ $lago->nombre }}</h3>
                <span class="badge {{ $badgeClase }}">
                    {{ $nivel }}
                </span>
            </div>

            @if ($resultado['monitoreo'])
                <div class="text-sm text-gray-600 mb-3">
                    Último monitoreo: {{ $resultado['monitoreo']->fecha_monitoreo->format('d/m/Y') }}
                </div>

                <div class="space-y-2">
                    @foreach ($resultado['recomendaciones'] as $rec)
                        @php
                            $color = match ($rec['tipo']) {
                                'alerta' => 'red',
                                'advertencia' => 'amber',
                                'recomendacion' => 'blue',
                                default => 'green',
                            };
                        @endphp
                        <div class="flex items-start gap-2">
                            <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-{{ $color }}-100 text-{{ $color }}-600 shrink-0 mt-0.5">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    @if ($rec['tipo'] === 'informacion')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    @endif
                                </svg>
                            </span>
                            <p class="text-sm text-{{ $color }}-800">{{ $rec['mensaje'] }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 mb-3">Sin monitoreos registrados. No es posible generar recomendaciones.</p>
                <a href="{{ route('monitoreos.create', $lago) }}"
                    class="btn-sm btn-primary">
                    + Registrar Monitoreo
                </a>
            @endif
        </div>

        <div class="flex items-center gap-2 ml-4 shrink-0">
            <a href="{{ route('recomendaciones.show', $lago) }}"
                class="btn-sm btn-primary">
                Ver Detalle
            </a>
        </div>
    </div>
</div>
