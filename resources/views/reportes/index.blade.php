<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Reportes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('reportes.partials._selector')

            @if ($tipo)
                @include('reportes.partials._filters')
                @include('reportes.partials._summary')
                @include('reportes.partials._preview_table')
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-12 text-center text-gray-500">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-lg font-medium">Selecciona un tipo de reporte para comenzar</p>
                        <p class="text-sm mt-1">Elige una opción del selector superior y haz clic en "Generar Vista Previa"</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
