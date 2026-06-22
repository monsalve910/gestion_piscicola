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

    <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-red-100">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">¿Eliminar venta?</h3>
            </div>
            <p class="text-sm text-gray-600 mb-6">
                Esta acción no se puede deshacer. El registro será eliminado permanentemente del sistema.
            </p>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="cerrarModalEliminar()"
                    class="btn-secondary btn-sm">
                    Cancelar
                </button>
                <form id="formEliminarVenta" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn-danger btn-sm">
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmarEliminar(url) {
            document.getElementById('formEliminarVenta').action = url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        function cerrarModalEliminar() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
