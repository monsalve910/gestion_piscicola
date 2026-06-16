<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lago') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('lagos.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Lago')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre"
                                :value="old('nombre')" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="ubicacion" :value="__('Ubicación')" />
                            <x-text-input id="ubicacion" class="block mt-1 w-full" type="text" name="ubicacion"
                                :value="old('ubicacion')" />
                            <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="tamano" :value="__('Área (m²)')" />
                                <x-text-input id="tamano" class="block mt-1 w-full" type="number" step="0.01" min="0" name="tamano"
                                    :value="old('tamano')" />
                                <x-input-error :messages="$errors->get('tamano')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="profundidad" :value="__('Profundidad (m)')" />
                                <x-text-input id="profundidad" class="block mt-1 w-full" type="number" step="0.01" min="0" name="profundidad"
                                    :value="old('profundidad')" />
                                <x-input-error :messages="$errors->get('profundidad')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="capacidad_maxima_peces" :value="__('Capacidad Máx. Peces')" />
                                <x-text-input id="capacidad_maxima_peces" class="block mt-1 w-full" type="number" min="0" name="capacidad_maxima_peces"
                                    :value="old('capacidad_maxima_peces')" />
                                <x-input-error :messages="$errors->get('capacidad_maxima_peces')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="estado" :value="__('Estado')" />
                            <select id="estado" name="estado" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" name="observaciones" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('observaciones') }}</textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('lagos.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Crear Lago') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
