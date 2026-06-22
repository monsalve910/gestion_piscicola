<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Reproducción') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form action="{{ route('reproducciones.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Especie</label>
                            <select name="especie_id" class="form-select mt-1 block w-full">
                                <option value="">-- Selecciona una especie --</option>
                                @foreach ($especies as $especie)
                                    <option value="{{ $especie->id }}" @selected(old('especie_id') == $especie->id)>
                                        {{ $especie->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especie_id') <p class="form-error mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="fecha" value="{{ old('fecha') }}"
                                class="form-input mt-1 block w-full">
                            @error('fecha') <p class="form-error mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" min="0" value="{{ old('cantidad', 0) }}"
                                class="form-input mt-1 block w-full">
                            @error('cantidad') <p class="form-error mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Observaciones</label>
                            <textarea name="observaciones" rows="3"
                                class="form-textarea mt-1 block w-full">{{ old('observaciones') }}</textarea>
                            @error('observaciones') <p class="form-error mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('reproducciones.index') }}" class="btn-secondary">Cancelar</a>
                            <button type="submit" class="btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>