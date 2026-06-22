<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recomendaciones: ') . $lago->nombre }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (!$lago->esActivo())
                <x-alert type="warning" message="Este lago está inactivo." />
            @endif

            @php $nivel = $resultado['nivel_riesgo']; @endphp

            @if ($nivel !== 'Sin Datos')
                @php
                    $clases = match ($nivel) {
                        'Alto Riesgo' => ['bg' => 'bg-red-50', 'border' => 'border-red-400', 'text' => 'text-red-800', 'icon' => 'text-red-400'],
                        'Requiere Atención' => ['bg' => 'bg-amber-50', 'border' => 'border-amber-400', 'text' => 'text-amber-800', 'icon' => 'text-amber-400'],
                        'Saludable' => ['bg' => 'bg-green-50', 'border' => 'border-green-400', 'text' => 'text-green-800', 'icon' => 'text-green-400'],
                    };
                @endphp

                <div class="border-l-4 {{ $clases['border'] }} {{ $clases['bg'] }} rounded-md p-4 mb-6">
                    <div class="flex items-start">
                        <div class="shrink-0 {{ $clases['icon'] }}">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                @if ($nivel === 'Saludable')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                @endif
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold {{ $clases['text'] }}">
                                Estado: {{ $nivel }}
                            </h3>
                            <p class="mt-1 text-sm {{ $clases['text'] }}">
                                @if ($nivel === 'Alto Riesgo')
                                    El lago presenta múltiples parámetros fuera de los rangos recomendados.
                                    Se requieren acciones correctivas urgentes.
                                @elseif ($nivel === 'Requiere Atención')
                                    El lago tiene al menos un parámetro fuera del rango óptimo.
                                    Se recomienda monitoreo y acciones preventivas.
                                @else
                                    Todos los parámetros del lago se encuentran dentro de los rangos óptimos.
                                    Mantener las condiciones actuales.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Recomendaciones Actuales</h3>
                            <form method="POST" action="{{ route('recomendaciones.generate-lake', $lago) }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="btn-primary text-sm">
                                    Actualizar Recomendaciones
                                </button>
                            </form>
                        </div>

                        @if ($resultado['monitoreo'])
                            <div class="mb-4 bg-gray-50 rounded-lg p-3 text-sm text-gray-600">
                                <div class="font-medium text-gray-700 mb-2">Basado en el monitoreo del {{ $resultado['monitoreo']->fecha_monitoreo->format('d/m/Y') }}</div>
                                <div class="flex flex-wrap gap-2">
                                    @if ($resultado['monitoreo']->temperatura_agua)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 text-xs font-medium">
                                            Temp: {{ $resultado['monitoreo']->temperatura_agua }}°C
                                        </span>
                                    @endif
                                    @if ($resultado['monitoreo']->ph)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-green-50 text-green-700 text-xs font-medium">
                                            pH: {{ $resultado['monitoreo']->ph }}
                                        </span>
                                    @endif
                                    @if ($resultado['monitoreo']->nivel_oxigeno)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-purple-50 text-purple-700 text-xs font-medium">
                                            O₂: {{ $resultado['monitoreo']->nivel_oxigeno }} mg/L
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach ($resultado['recomendaciones'] as $rec)
                                    @php
                                        $color = match ($rec['tipo']) {
                                            'alerta' => 'red',
                                            'advertencia' => 'amber',
                                            'recomendacion' => 'blue',
                                            default => 'green',
                                        };
                                        $icono = match ($rec['tipo']) {
                                            'alerta' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>',
                                            'advertencia' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                            'recomendacion' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                            default => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                        };
                                    @endphp
                                    <div class="flex items-start gap-3 p-3 rounded-lg bg-{{ $color }}-50 border border-{{ $color }}-200">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-{{ $color }}-100 text-{{ $color }}-600 shrink-0">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                {!! $icono !!}
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-{{ $color }}-800">{{ $rec['mensaje'] }}</p>
                                            <span class="inline-block mt-1 px-2 py-0.5 rounded text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">
                                                {{ ucfirst($rec['tipo']) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No hay monitoreos registrados para este lago.</p>
                        @endif
                    </div>
                </div>

                @if ($historial->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Historial de Recomendaciones</h3>
                            <div class="space-y-3">
                                @foreach ($historial->groupBy(function ($item) { return $item->created_at->format('d/m/Y H:i'); }) as $fecha => $grupo)
                                    <div class="border rounded-lg overflow-hidden">
                                        <div class="bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 border-b">
                                            {{ $fecha }}
                                        </div>
                                        <div class="divide-y divide-gray-100">
                                            @foreach ($grupo as $rec)
                                                @php
                                                    $color = match ($rec->tipo) {
                                                        'alerta' => 'red',
                                                        'advertencia' => 'amber',
                                                        'recomendacion' => 'blue',
                                                        default => 'green',
                                                    };
                                                @endphp
                                                <div class="px-4 py-3 flex items-start gap-2">
                                                    <span class="inline-flex items-center justify-center h-5 w-5 rounded-full bg-{{ $color }}-100 text-{{ $color }}-600 shrink-0 mt-0.5">
                                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </span>
                                                    <div>
                                                        <p class="text-sm text-gray-700">{{ $rec->mensaje }}</p>
                                                        <div class="flex gap-2 mt-1">
                                                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-{{ $color }}-100 text-{{ $color }}-700">
                                                                {{ ucfirst($rec->tipo) }}
                                                            </span>
                                                            <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                                                {{ $rec->nivel_riesgo }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6">
                        <div class="flex flex-col items-center justify-center text-gray-400 py-8">
                            <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <p class="text-base font-medium text-gray-500">Sin datos de monitoreo</p>
                            <p class="text-sm mt-1">No se han registrado monitoreos para este lago.</p>
                            <a href="{{ route('monitoreos.create', $lago) }}"
                                class="btn-primary text-sm mt-4">
                                + Registrar Monitoreo
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="mt-6 flex items-center gap-4">
                <a href="{{ route('recomendaciones.index') }}"
                    class="btn-secondary">
                    Volver a Recomendaciones
                </a>
                <a href="{{ route('lagos.show', $lago) }}"
                    class="btn-primary">
                    Ver Lago
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
