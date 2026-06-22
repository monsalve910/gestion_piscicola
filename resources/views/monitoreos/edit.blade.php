<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Monitoreo - ') . $lago->nombre }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-alert type="info"
                :message="'Editando monitoreo del ' . $monitoreo->fecha_monitoreo->format('d/m/Y') . ' — Registrado el ' . $monitoreo->created_at->format('d/m/Y')" />

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('monitoreos.update', [$lago, $monitoreo]) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="fecha_monitoreo" :value="__('Fecha del Monitoreo')" />
                                <x-text-input id="fecha_monitoreo" type="date" name="fecha_monitoreo"
                                    :value="old('fecha_monitoreo', $monitoreo->fecha_monitoreo->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('fecha_monitoreo')" />
                            </div>

                            <div>
                                <x-input-label for="estado_general" :value="__('Estado General')" />
                                <select id="estado_general" name="estado_general" required class="form-select">
                                    <option value="bueno" {{ old('estado_general', $monitoreo->estado_general) == 'bueno' ? 'selected' : '' }}>Bueno</option>
                                    <option value="regular" {{ old('estado_general', $monitoreo->estado_general) == 'regular' ? 'selected' : '' }}>Regular</option>
                                    <option value="malo" {{ old('estado_general', $monitoreo->estado_general) == 'malo' ? 'selected' : '' }}>Malo</option>
                                </select>
                                <x-input-error :messages="$errors->get('estado_general')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-input-label for="temperatura_agua" :value="__('Temperatura del Agua (°C)')" />
                                <x-text-input id="temperatura_agua" type="number" step="0.01" name="temperatura_agua"
                                    :value="old('temperatura_agua', $monitoreo->temperatura_agua)" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('temperatura_agua')" />
                            </div>

                            <div>
                                <x-input-label for="ph" :value="__('pH')" />
                                <x-text-input id="ph" type="number" step="0.01" min="0" max="14" name="ph"
                                    :value="old('ph', $monitoreo->ph)" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('ph')" />
                            </div>

                            <div>
                                <x-input-label for="nivel_oxigeno" :value="__('Oxígeno (mg/L)')" />
                                <x-text-input id="nivel_oxigeno" type="number" step="0.01" name="nivel_oxigeno"
                                    :value="old('nivel_oxigeno', $monitoreo->nivel_oxigeno)" placeholder="0.00" />
                                <x-input-error :messages="$errors->get('nivel_oxigeno')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" name="observaciones" rows="4" class="form-textarea">{{ old('observaciones', $monitoreo->observaciones) }}</textarea>
                            <x-input-error :messages="$errors->get('observaciones')" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('monitoreos.index', $lago) }}"
                                class="btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn-primary">
                                {{ __('Actualizar Monitoreo') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
