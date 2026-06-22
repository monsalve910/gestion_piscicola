<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Lagos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div x-data="{
                            search: '{{ $search ?? '' }}',
                            searchLagos() {
                                fetch('{{ route('lagos.index') }}?search=' + encodeURIComponent(this.search), {
                                    headers: { 'Accept': 'application/json' },
                                    credentials: 'same-origin'
                                })
                                .then(r => r.json())
                                .then(data => {
                                    document.getElementById('lagos-tbody').innerHTML = data.tbody;
                                    document.getElementById('lagos-pagination').innerHTML = data.pagination;
                                });
                            }
                        }">
                            <input type="text" placeholder="Buscar lagos..."
                                x-model="search"
                                @input.debounce.200ms="searchLagos()"
                                class="form-input">
                        </div>
                        <a href="{{ route('lagos.create') }}"
                            class="btn-primary">
                            + Nuevo Lago
                        </a>
                    </div>

                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Ubicación</th>
                                <th class="px-4 py-3">Tamaño</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Registro</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lagos-tbody" class="divide-y divide-gray-200">
                            @include('lagos._table')
                        </tbody>
                    </table>

                    <div id="lagos-pagination" class="mt-4">
                        {{ $lagos->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
