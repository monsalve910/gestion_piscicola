<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recomendaciones del Sistema') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div x-data="{
                            search: '{{ $search ?? '' }}',
                            searchRecomendaciones() {
                                fetch('{{ route('recomendaciones.index') }}?search=' + encodeURIComponent(this.search), {
                                    headers: { 'Accept': 'application/json' },
                                    credentials: 'same-origin'
                                })
                                .then(r => r.json())
                                .then(data => {
                                    document.getElementById('recomendaciones-cards').innerHTML = data.cards;
                                    document.getElementById('recomendaciones-pagination').innerHTML = data.pagination;
                                });
                            }
                        }">
                            <input type="text" placeholder="Buscar lago..."
                                x-model="search"
                                @input.debounce.200ms="searchRecomendaciones()"
                                class="rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                        </div>
                        <form method="POST" action="{{ route('recomendaciones.generate') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                                Generar Recomendaciones
                            </button>
                        </form>
                    </div>

                    <div id="recomendaciones-cards" class="space-y-4">
                        @forelse ($lagos as $lago)
                            @php $resultado = $datos[$lago->id]; @endphp
                            @include('recomendaciones._card', ['lago' => $lago, 'resultado' => $resultado])
                        @empty
                            <div class="flex flex-col items-center justify-center text-gray-400 py-12">
                                <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <p class="text-base font-medium text-gray-500">No se encontraron lagos</p>
                                <p class="text-sm mt-1">
                                    @if ($search)
                                        Intenta con otros términos de búsqueda.
                                    @else
                                        Aún no hay lagos registrados.
                                    @endif
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <div id="recomendaciones-pagination" class="mt-4">
                        {{ $lagos->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
