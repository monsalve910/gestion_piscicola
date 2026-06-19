<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Especie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('especies.update', $especie) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $especie->nombre) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('descripcion', $especie->descripcion) }}</textarea>
                            @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                            <input type="number" name="cantidad" min="0" value="{{ old('cantidad', $especie->cantidad) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('cantidad') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Lago</label>
                            <select name="lago_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach ($lagos as $lago)
                                    <option value="{{ $lago->id }}" @selected(old('lago_id', $especie->lago_id) == $lago->id)>
                                        {{ $lago->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lago_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('especies.index') }}" class="px-4 py-2 bg-gray-200 rounded-md">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>