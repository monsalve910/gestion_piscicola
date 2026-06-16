<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Monitoreo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="space-y-4">
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">ID</dt>
                            <dd class="w-2/3">{{ $monitoreo->id }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Lago</dt>
                            <dd class="w-2/3">{{ $lago->nombre }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Fecha</dt>
                            <dd class="w-2/3">{{ $monitoreo->fecha_monitoreo->format('d/m/Y') }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Temperatura</dt>
                            <dd class="w-2/3">{{ $monitoreo->temperatura_agua ? $monitoreo->temperatura_agua . ' °C' : 'No registrada' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">pH</dt>
                            <dd class="w-2/3">{{ $monitoreo->ph ?? 'No registrado' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Nivel de Oxígeno</dt>
                            <dd class="w-2/3">{{ $monitoreo->nivel_oxigeno ? $monitoreo->nivel_oxigeno . ' mg/L' : 'No registrado' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Estado General</dt>
                            <dd class="w-2/3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $monitoreo->estado_general == 'bueno' ? 'bg-green-100 text-green-700' : ($monitoreo->estado_general == 'regular' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($monitoreo->estado_general) }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Observaciones</dt>
                            <dd class="w-2/3">{{ $monitoreo->observaciones ?? 'Sin observaciones' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Registrado</dt>
                            <dd class="w-2/3">{{ $monitoreo->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Última actualización</dt>
                            <dd class="w-2/3">{{ $monitoreo->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('monitoreos.index', $lago) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Volver
                        </a>
                        <a href="{{ route('monitoreos.edit', [$lago, $monitoreo]) }}"
                            class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
