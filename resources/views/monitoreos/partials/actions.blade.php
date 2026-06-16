<div class="flex items-center gap-2">
    <a href="{{ route('monitoreos.show', [$lago, $monitoreo]) }}"
        class="text-cyan-600 hover:text-cyan-900 text-sm font-medium">
        Ver
    </a>
    <a href="{{ route('monitoreos.edit', [$lago, $monitoreo]) }}"
        class="text-blue-600 hover:text-blue-900 text-sm font-medium">
        Editar
    </a>
    <button type="button"
        onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-monitoreo-{{ $monitoreo->id }}' }))"
        class="text-sm font-medium text-red-600 hover:text-red-900">
        Eliminar
    </button>

    <x-modal name="delete-monitoreo-{{ $monitoreo->id }}" :show="false" maxWidth="md">
        <div class="p-6">
            <div class="flex items-start gap-3">
                <div class="shrink-0 text-red-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Eliminar Monitoreo</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        ¿Estás seguro de que deseas eliminar el monitoreo del <strong>{{ $monitoreo->fecha_monitoreo->format('d/m/Y') }}</strong>?
                    </p>
                    <p class="mt-1 text-xs text-gray-400">Esta acción no se puede deshacer.</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button @click="$dispatch('close-modal', 'delete-monitoreo-{{ $monitoreo->id }}')">
                    Cancelar
                </x-secondary-button>
                <form method="POST" action="{{ route('monitoreos.destroy', [$lago, $monitoreo]) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Sí, eliminar
                    </button>
                </form>
            </div>
        </div>
    </x-modal>
</div>
