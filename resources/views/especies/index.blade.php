<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Especies') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-4">
                        <div x-data="{
                            search: '{{ $search ?? '' }}',
                            searchEspecies() {
                                fetch('{{ route('especies.index') }}?search=' + encodeURIComponent(this.search), {
                                    headers: { 'Accept': 'application/json' },
                                    credentials: 'same-origin'
                                })
                                .then(r => r.json())
                                .then(data => {
                                    document.getElementById('especies-tbody').innerHTML = data.tbody;
                                    document.getElementById('especies-pagination').innerHTML = data.pagination;
                                });
                            }
                        }">
                            <input type="text" placeholder="Buscar especies..."
                                x-model="search"
                                @input.debounce.200ms="searchEspecies()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                        </div>
                        <a href="{{ route('especies.create') }}"
                            class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                            + Nueva Especie
                        </a>
                    </div>

                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Cantidad</th>
                                <th class="px-4 py-3">Lago</th>
                                <th class="px-4 py-3">Registro</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="especies-tbody" class="divide-y divide-gray-200">
                            @include('especies._table')
                        </tbody>
                    </table>

                    <div id="especies-pagination" class="mt-4">
                        @include('especies._pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmación de eliminación -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-red-100">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">¿Eliminar especie?</h3>
        </div>
        <p class="text-sm text-gray-600 mb-6">
            Esta acción no se puede deshacer. La especie será eliminada permanentemente del sistema.
        </p>
        <div class="flex justify-end gap-3">
            <button type="button" onclick="cerrarModalEliminar()"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                Cancelar
            </button>
            <form id="formEliminarEspecie" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                    Sí, eliminar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmarEliminar(url) {
        document.getElementById('formEliminarEspecie').action = url;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function cerrarModalEliminar() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</x-app-layout>