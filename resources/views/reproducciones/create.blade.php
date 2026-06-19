<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Reproducción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('reproducciones.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Especie</label>
                            <select name="especie_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">-- Selecciona una especie --</option>
                                @foreach ($especies as $especie)
                                    <option value="{{ $especie->id }}" @selected(old('especie_id') == $especie->id)>
                                        {{ $especie->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especie_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Fecha</label>
                            <input type="date" name="fecha" value="{{ old('fecha') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('fecha') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                            <input type="number" name="cantidad" min="0" value="{{ old('cantidad', 0) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('cantidad') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                            <textarea name="observaciones" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('observaciones') }}</textarea>
                            @error('observaciones') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('reproducciones.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>