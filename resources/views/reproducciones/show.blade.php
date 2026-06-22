<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Reproducción') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">

                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Especie</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $reproduccion->especie->nombre ?? 'N/A' }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Fecha</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $reproduccion->fecha->format('d/m/Y') }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Cantidad</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $reproduccion->cantidad }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Observaciones</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $reproduccion->observaciones ?? 'Sin observaciones' }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Registrado</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $reproduccion->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('reproducciones.index') }}" class="btn-secondary">
                            Volver
                        </a>
                        <a href="{{ route('reproducciones.edit', $reproduccion) }}" class="btn-primary">
                            Editar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>