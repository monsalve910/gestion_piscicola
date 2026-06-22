<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Monitoreos de: ') . $lago->nombre }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div x-data="{
                            search: '{{ $search ?? '' }}',
                            searchMonitoreos() {
                                fetch('{{ route('monitoreos.index', $lago) }}?search=' + encodeURIComponent(this.search), {
                                    headers: { 'Accept': 'application/json' },
                                    credentials: 'same-origin'
                                })
                                .then(r => r.json())
                                .then(data => {
                                    document.getElementById('monitoreos-tbody').innerHTML = data.tbody;
                                    document.getElementById('monitoreos-pagination').innerHTML = data.pagination;
                                });
                            }
                        }">
                            <input type="text" placeholder="Buscar monitoreos..."
                                x-model="search"
                                @input.debounce.200ms="searchMonitoreos()"
                                class="form-input">
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('lagos.show', $lago) }}"
                                class="btn-secondary">
                                Volver al Lago
                            </a>
                            <a href="{{ route('monitoreos.create', $lago) }}"
                                class="btn-primary">
                                + Nuevo Monitoreo
                            </a>
                        </div>
                    </div>

                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Temperatura</th>
                                <th class="px-4 py-3">pH</th>
                                <th class="px-4 py-3">Oxígeno</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="monitoreos-tbody" class="divide-y divide-gray-200">
                            @include('monitoreos._table')
                        </tbody>
                    </table>

                    <div id="monitoreos-pagination" class="mt-4">
                        {{ $monitoreos->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
