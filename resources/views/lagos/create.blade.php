<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lago') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('lagos.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre del Lago')" class="form-label" />
                            <x-text-input id="nombre" class="block mt-1 w-full form-input" type="text" name="nombre"
                                :value="old('nombre')" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2 form-error" />
                        </div>

                        <div>
                            <x-input-label for="ubicacion" :value="__('Ubicación')" class="form-label" />
                            <x-text-input id="ubicacion" class="block mt-1 w-full form-input" type="text" name="ubicacion"
                                :value="old('ubicacion')" />
                            <x-input-error :messages="$errors->get('ubicacion')" class="mt-2 form-error" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="tamano" :value="__('Área (m²)')" class="form-label" />
                                <x-text-input id="tamano" class="block mt-1 w-full form-input" type="number" step="0.01" min="0" name="tamano"
                                    :value="old('tamano')" />
                                <x-input-error :messages="$errors->get('tamano')" class="mt-2 form-error" />
                            </div>

                            <div>
                                <x-input-label for="profundidad" :value="__('Profundidad (m)')" class="form-label" />
                                <x-text-input id="profundidad" class="block mt-1 w-full form-input" type="number" step="0.01" min="0" name="profundidad"
                                    :value="old('profundidad')" />
                                <x-input-error :messages="$errors->get('profundidad')" class="mt-2 form-error" />
                            </div>

                            <div>
                                <x-input-label for="capacidad_maxima_peces" :value="__('Capacidad Máx. Peces')" class="form-label" />
                                <x-text-input id="capacidad_maxima_peces" class="block mt-1 w-full form-input" type="number" min="0" name="capacidad_maxima_peces"
                                    :value="old('capacidad_maxima_peces')" />
                                <x-input-error :messages="$errors->get('capacidad_maxima_peces')" class="mt-2 form-error" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="estado" :value="__('Estado')" class="form-label" />
                            <select id="estado" name="estado" required
                                class="form-select">
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <x-input-error :messages="$errors->get('estado')" class="mt-2 form-error" />
                        </div>

                        <div>
                            <x-input-label for="observaciones" :value="__('Observaciones')" class="form-label" />
                            <textarea id="observaciones" name="observaciones" rows="4"
                                class="form-textarea">{{ old('observaciones') }}</textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2 form-error" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('lagos.index') }}"
                                class="btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn-primary">
                                {{ __('Crear Lago') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
