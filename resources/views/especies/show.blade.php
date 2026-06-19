<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Especie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->nombre }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->descripcion ?? 'Sin descripción' }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Cantidad</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->cantidad }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Lago</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->lago->nombre ?? 'N/A' }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Registrado</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->created_at->format('d/m/Y H:i') }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $especie->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('especies.index') }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                            Volver
                        </a>
                        <a href="{{ route('especies.edit', $especie) }}" class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                            Editar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>