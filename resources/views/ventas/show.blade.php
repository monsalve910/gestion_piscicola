<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle de Venta') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">

                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Especie</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $venta->especie->nombre ?? 'N/A' }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Peso (kg)</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ number_format($venta->peso_kg, 2) }} kg</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Precio por kg</dt>
                            <dd class="text-sm text-gray-900 col-span-2">${{ number_format($venta->precio_unitario, 2) }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Total</dt>
                            <dd class="text-sm text-gray-900 col-span-2">${{ number_format($venta->total, 2) }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Fecha de Venta</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $venta->fecha_venta->format('d/m/Y') }}</dd>
                        </div>

                        <div class="py-3 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-gray-500">Registrado</dt>
                            <dd class="text-sm text-gray-900 col-span-2">{{ $venta->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('ventas.index') }}" class="btn-secondary">
                            Volver
                        </a>
                        <a href="{{ route('ventas.edit', $venta) }}" class="btn-primary">
                            Editar
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
