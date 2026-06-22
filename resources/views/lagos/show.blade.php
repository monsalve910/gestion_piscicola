<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Lago') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (!$lago->esActivo())
                <x-alert type="warning"
                    message="Este lago está inactivo." />
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <dl class="space-y-4">
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">ID</dt>
                            <dd class="w-2/3">{{ $lago->id }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Nombre</dt>
                            <dd class="w-2/3">{{ $lago->nombre }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Ubicación</dt>
                            <dd class="w-2/3">{{ $lago->ubicacion ?? 'No registrada' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Área</dt>
                            <dd class="w-2/3">{{ $lago->tamano ? number_format($lago->tamano, 2) . ' m²' : 'No registrada' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Profundidad</dt>
                            <dd class="w-2/3">{{ $lago->profundidad ? number_format($lago->profundidad, 2) . ' m' : 'No registrada' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Capacidad Máx. Peces</dt>
                            <dd class="w-2/3">{{ $lago->capacidad_maxima_peces ? number_format($lago->capacidad_maxima_peces) : 'No registrada' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Estado</dt>
                            <dd class="w-2/3">
                                <span class="{{ $lago->esActivo() ? 'badge-success' : 'badge-danger' }}">
                                    {{ $lago->esActivo() ? 'Activo' : 'Inactivo' }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Observaciones</dt>
                            <dd class="w-2/3">{{ $lago->observaciones ?? 'Sin observaciones' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Registrado</dt>
                            <dd class="w-2/3">{{ $lago->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Última actualización</dt>
                            <dd class="w-2/3">{{ $lago->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('lagos.index') }}"
                            class="btn-secondary">
                            Volver
                        </a>
                        <a href="{{ route('lagos.edit', $lago) }}"
                            class="btn-primary">
                            Editar
                        </a>
                    </div>
                </div>
            </div>

            @if ($lago->monitoreos->count() > 0)
                <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Historial de Monitoreos</h3>
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-4 py-3">Fecha</th>
                                    <th class="px-4 py-3">Temperatura</th>
                                    <th class="px-4 py-3">pH</th>
                                    <th class="px-4 py-3">Oxígeno</th>
                                    <th class="px-4 py-3">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($lago->monitoreos->sortByDesc('fecha_monitoreo')->take(5) as $monitoreo)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $monitoreo->fecha_monitoreo->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ $monitoreo->temperatura_agua ? $monitoreo->temperatura_agua . ' °C' : '—' }}</td>
                                        <td class="px-4 py-3">{{ $monitoreo->ph ?? '—' }}</td>
                                        <td class="px-4 py-3">{{ $monitoreo->nivel_oxigeno ? $monitoreo->nivel_oxigeno . ' mg/L' : '—' }}</td>
                                        <td class="px-4 py-3">{{ ucfirst($monitoreo->estado_general) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <a href="{{ route('monitoreos.index', $lago) }}"
                                class="text-cyan-600 hover:text-cyan-900 text-sm font-medium">
                                Ver todos los monitoreos →
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
