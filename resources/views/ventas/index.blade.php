<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">

                    @if (session('success'))
                        <x-alert type="success" :message="session('success')" />
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <div x-data="{
                            search: '{{ $search ?? '' }}',
                            searchVentas() {
                                fetch('{{ route('ventas.index') }}?search=' + encodeURIComponent(this.search), {
                                    headers: { 'Accept': 'application/json' },
                                    credentials: 'same-origin'
                                })
                                .then(r => r.json())
                                .then(data => {
                                    document.getElementById('ventas-tbody').innerHTML = data.tbody;
                                    document.getElementById('ventas-pagination').innerHTML = data.pagination;
                                });
                            }
                        }">
                            <input type="text" placeholder="Buscar por especie..."
                                x-model="search"
                                @input.debounce.200ms="searchVentas()"
                                class="form-input">
                        </div>
                        <a href="{{ route('ventas.create') }}"
                            class="btn-primary">
                            + Nueva Venta
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3">Especie</th>
                                <th class="px-4 py-3">Peso (kg)</th>
                                <th class="px-4 py-3">Precio por kg</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Fecha Venta</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="ventas-tbody" class="divide-y divide-gray-200">
                            @include('ventas._table')
                        </tbody>
                    </table>
                    </div>

                    <div id="ventas-pagination" class="mt-4">
                        @include('ventas._pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
