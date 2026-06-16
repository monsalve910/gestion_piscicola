<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Monitoreo - ') . $lago->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('monitoreos.store', $lago) }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="fecha_monitoreo" :value="__('Fecha del Monitoreo')" />
                                <x-text-input id="fecha_monitoreo" class="block mt-1 w-full" type="date" name="fecha_monitoreo"
                                    :value="old('fecha_monitoreo', date('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('fecha_monitoreo')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="estado_general" :value="__('Estado General')" />
                                <select id="estado_general" name="estado_general" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">
                                    <option value="bueno" {{ old('estado_general') == 'bueno' ? 'selected' : '' }}>Bueno</option>
                                    <option value="regular" {{ old('estado_general') == 'regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="malo" {{ old('estado_general') == 'malo' ? 'selected' : '' }}>Malo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado_general')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="temperatura_agua" :value="__('Temperatura del Agua (°C)')" />
                                <x-text-input id="temperatura_agua" class="block mt-1 w-full" type="number" step="0.01" name="temperatura_agua"
                                    :value="old('temperatura_agua')" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('temperatura_agua')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ph" :value="__('pH')" />
                                <x-text-input id="ph" class="block mt-1 w-full" type="number" step="0.01" min="0" max="14" name="ph"
                                    :value="old('ph')" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('ph')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nivel_oxigeno" :value="__('Oxígeno (mg/L)')" />
                                <x-text-input id="nivel_oxigeno" class="block mt-1 w-full" type="number" step="0.01" name="nivel_oxigeno"
                                    :value="old('nivel_oxigeno')" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('nivel_oxigeno')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" name="observaciones" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-cyan-500 focus:ring-cyan-500">{{ old('observaciones') }}</textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('monitoreos.index', $lago) }}"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Registrar Monitoreo') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
