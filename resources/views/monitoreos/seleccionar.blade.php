<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seleccionar Lago para Monitoreo') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($lagos as $lago)
                    <a href="{{ route('monitoreos.index', $lago) }}"
                       class="block bg-white rounded-xl shadow-sm border border-gray-200 hover:shadow-md hover:border-cyan-300 transition-all duration-200 overflow-hidden group">
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-cyan-600 transition-colors">
                                    {{ $lago->nombre }}
                                </h3>
                                <span class="shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold
                                    {{ $lago->esActivo() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $lago->esActivo() ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>

                            @if ($lago->especie)
                                <div class="mb-3">
                                    <span class="text-xs text-gray-500">Especie:</span>
                                    <span class="text-sm font-medium text-gray-700 ml-1">{{ $lago->especie->nombre }}</span>
                                    @if ($lago->especie->tieneParametrosIdeales())
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            <span class="inline-block px-1.5 py-0.5 rounded text-[10px] font-medium bg-blue-50 text-blue-600">
                                                T: {{ $lago->especie->temp_min }}°C - {{ $lago->especie->temp_max }}°C
                                            </span>
                                            <span class="inline-block px-1.5 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-600">
                                                pH: {{ $lago->especie->ph_min }} - {{ $lago->especie->ph_max }}
                                            </span>
                                            <span class="inline-block px-1.5 py-0.5 rounded text-[10px] font-medium bg-teal-50 text-teal-600">
                                                O₂: {{ $lago->especie->oxigeno_min }} - {{ $lago->especie->oxigeno_max }} mg/L
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <p class="text-xs text-gray-400 mb-3">Sin especie asignada</p>
                            @endif

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">
                                    {{ $lago->tamano ? number_format($lago->tamano, 0) . ' m²' : '—' }}
                                </span>
                                <span class="text-cyan-600 font-medium text-sm group-hover:underline">
                                    Ver monitoreos →
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center text-gray-400 py-12">
                        <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <p class="text-base font-medium text-gray-500">No hay lagos registrados</p>
                        <p class="text-sm mt-1">Crea un lago primero para registrar monitoreos.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
